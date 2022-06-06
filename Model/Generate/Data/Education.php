<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\EducationInterface;
use Magento\Framework\DataObject;

/**
 * Model Education
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Education extends DataObject implements EducationInterface
{
    /**
     * @inheritDoc
     */
    public function getFrom(): ?string
    {
        return $this->getData(static::FROM_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setFrom(string $from)
    {
        return $this->setData(static::FROM_DATE, $from);
    }

    /**
     * @inheritDoc
     */
    public function getTo(): ?string
    {
        return $this->getData(static::TO_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setTo(string $to)
    {
        return $this->setData(static::TO_DATE, $to);
    }

    /**
     * @inheritDoc
     */
    public function getInstitution(): ?string
    {
        return $this->getData(static::INSTITUTION);
    }

    /**
     * @inheritDoc
     */
    public function setInstitution(string $institution)
    {
        return $this->setData(static::INSTITUTION, $institution);
    }

    /**
     * @inheritDoc
     */
    public function getResponsibility(): ?string
    {
        return $this->getData(static::RESPONSIBILITY);
    }

    /**
     * @inheritDoc
     */
    public function setResponsibility(string $responsibility)
    {
        return $this->setData(static::RESPONSIBILITY, $responsibility);
    }
}