<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Validator;

use Victor3w\Resume\Api\ValidatorInterface;

/**
 * Validator CommonField
 * @package Victor3w\Resume\Model\Generate\Validator
 */
abstract class CommonField implements ValidatorInterface
{
    /**
     * @var array
     */
    protected array $messages = [];

    /**
     * @inheritDoc
     */
    public function getErrorMessage(): string
    {
        $preparedMessages = array_map(function ($message) {
            return __($message)->getText();
        }, $this->messages);
        return implode(" \n", $preparedMessages);
    }
}