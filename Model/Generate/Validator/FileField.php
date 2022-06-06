<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Validator;

use Victor3w\Resume\Api\Data\ResumeInterface;

/**
 * Validator FileField
 * @package Victor3w\Resume\Model\Generate\Validator
 */
class FileField extends CommonField
{
    public const FILE_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];

    public const MAX_FILE_SIZE = 1024 * 1024;

    /**
     * @inheritDoc
     */
    public function validate(ResumeInterface $resume): bool
    {
        $this->messages = [];
        $photo = $resume->getPhoto();
        if (!$photo || $photo->getError() === UPLOAD_ERR_NO_FILE) {
            return true;
        }
        if (!is_uploaded_file($photo->getTmpName())) {
            $this->messages[] = 'Please, check your file';
            return false;
        }
        $type = mime_content_type($photo->getTmpName());
        if (!in_array($type, static::FILE_TYPES, true)) {
            $this->messages[] = sprintf(
                'You can use only %s types of File',
                implode(', ', static::FILE_TYPES)
            );
            return false;
        }
        if (filesize($photo->getTmpName()) > static::MAX_FILE_SIZE) {
            $this->messages[] = sprintf(
                'Max File size is %d. Please, select other IMG',
               static::MAX_FILE_SIZE
            );
            return false;
        }
        if ($photo->getError()) {
            $this->messages[] = 'Please, check your file or change it';
            return false;
        }
        return true;
    }
}