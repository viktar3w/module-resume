<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter PhoneField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class PhoneField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $filter = static function (string $field): string {
            $preparedField = filter_var($field, FILTER_SANITIZE_NUMBER_INT);
            return str_replace(['-', '+'], "", $preparedField);
        };
        $resume->setPhone($filter($resume->getPhone()));
    }
}