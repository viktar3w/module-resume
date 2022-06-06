<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter EmailField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class EmailField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $filter = static function (string $field): string {
            return filter_var($field, FILTER_SANITIZE_EMAIL);
        };
        $resume->setEmail($filter($resume->getEmail()));
    }
}