<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface EducationInterface
 * @package Victor3w\Resume\Api\Data
 */
interface EducationInterface extends DateIntervalInterface
{
    public const INSTITUTION = 'institution';
    public const RESPONSIBILITY = 'responsibility';
    public const EDUCATION = 'education';

    /**
     * @return string|null
     */
    public function getInstitution(): ?string;

    /**
     * @param string $institution
     * @return self
     */
    public function setInstitution(string $institution);

    /**
     * @return string|null
     */
    public function getResponsibility(): ?string;

    /**
     * @param string $responsibility
     * @return self
     */
    public function setResponsibility(string $responsibility);
}