<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\SkillInterface;
use Magento\Framework\DataObject;

/**
 * Model Skill
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Skill extends DataObject implements SkillInterface
{
    /**
     * @inheritDoc
     */
    public function getSkill(): ?string
    {
        return $this->getData(static::SKILL);
    }

    /**
     * @inheritDoc
     */
    public function setSkill(string $skill)
    {
        return $this->setData(static::SKILL, $skill);
    }
}