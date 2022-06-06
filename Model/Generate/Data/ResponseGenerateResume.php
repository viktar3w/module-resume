<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\ResponseGenerateInterface;
use Magento\Framework\DataObject;

/**
 * Model ResponseGenerateResume
 * @package Victor3w\Resume\Model\Generate\Data
 */
class ResponseGenerateResume extends DataObject implements ResponseGenerateInterface
{
    /**
     * @inheritDoc
     */
    public function getError(): bool
    {
        return $this->getData(static::ERROR) ?? false;
    }

    /**
     * @inheritDoc
     */
    public function setError(bool $error)
    {
        return $this->setData(static::ERROR, $error);
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->getData(static::MESSAGE) ?? '';
    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message)
    {
        return $this->setData(static::MESSAGE, $message);
    }

    /**
     * @inheritDoc
     */
    public function getFileContent()
    {
        return $this->getData(static::FILE_CONTENT) ?? '';
    }

    /**
     * @inheritDoc
     */
    public function setFileContent(string $fileContent)
    {
        return $this->setData(static::FILE_CONTENT, $fileContent);
    }
}