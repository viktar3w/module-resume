<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\ExperienceInterface;
use Magento\Framework\DataObject;

/**
 * Model Experience
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Experience extends DataObject implements ExperienceInterface
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
    public function getCompany(): ?string
    {
        return $this->getData(static::COMPANY);
    }

    /**
     * @inheritDoc
     */
    public function setCompany(string $company)
    {
        return $this->setData(static::COMPANY, $company);
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): ?string
    {
        return $this->getData(static::POSITION);
    }

    /**
     * @inheritDoc
     */
    public function setPosition(string $position)
    {
        return $this->setData(static::POSITION, $position);
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