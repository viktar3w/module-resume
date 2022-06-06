<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\ValidatorInterface;
use Victor3w\Resume\Model\Generate\Messenger;

/**
 * Validator GeneratePostValidator
 * @package Victor3w\Resume\Model
 */
class GeneratePostValidator implements ValidatorInterface
{
    /**@var Messenger */
    private Messenger $messenger;

    /**@var ValidatorInterface[] */
    private array $validators;

    /**
     * @param Messenger $messenger
     * @param array $validators
     */
    public function __construct(
        Messenger $messenger,
        array $validators = []
    ) {
        $this->messenger = $messenger;
        $this->validators = $validators;
    }

    /**
     * @inheritDoc
     */
    public function validate(ResumeInterface $resume): bool
    {
        $this->messenger->clear($this->messenger::ERROR_TYPE);
        foreach ($this->validators as $validator) {
            if (!$validator->validate($resume)) {
                $this->messenger->addError(
                    $this->messenger::ERROR_TYPE,
                    $validator->getErrorMessage()
                );
            }
        }
        return empty($this->messenger->getMessages($this->messenger::ERROR_TYPE));
    }

    /**
     * @inheritDoc
     */
    public function getErrorMessage(): string
    {
        return '';
    }
}
