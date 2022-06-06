<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface SkillInterface
 * @package Victor3w\Resume\Api\Data
 */
interface SkillInterface
{
    public const SKILL = 'skill';
    public const SKILLS = 'skills';

    /**
     * @return string|null
     */
    public function getSkill(): ?string;

    /**
     * @param string $skill
     * @return self
     */
    public function setSkill(string $skill);
}