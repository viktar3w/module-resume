<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface ExperienceInterface
 * @package Victor3w\Resume\Api\Data
 */
interface ExperienceInterface extends DateIntervalInterface
{
    public const COMPANY = 'company';
    public const POSITION = 'position';
    public const RESPONSIBILITY = 'responsibility';
    public const EXPERIENCES = 'experiences';

    /**
     * @return string|null
     */
    public function getCompany(): ?string;

    /**
     * @param string $company
     * @return self
     */
    public function setCompany(string $company);

    /**
     * @return string|null
     */
    public function getPosition(): ?string;

    /**
     * @param string $position
     * @return self
     */
    public function setPosition(string $position);

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