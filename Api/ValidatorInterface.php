<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api;

use Victor3w\Resume\Api\Data\ResumeInterface;

/**
 * Interface ValidatorInterface
 * @package Victor3w\Resume\Api
 */
interface ValidatorInterface
{
    /**
     * @param ResumeInterface $resume
     * @return bool
     */
    public function validate(ResumeInterface $resume): bool;

    /**
     * @return string
     */
    public function getErrorMessage(): string;
}
