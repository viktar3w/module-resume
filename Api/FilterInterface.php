<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api;

use Victor3w\Resume\Api\Data\ResumeInterface;

/**
 * Interface FilterInterface
 * @package Victor3w\Resume\Api
 */
interface FilterInterface
{
    /**
     * @param ResumeInterface $resume
     * @return void
     */
    public function filter(ResumeInterface $resume): void;
}