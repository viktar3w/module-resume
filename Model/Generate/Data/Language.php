<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\LanguageInterface;
use Magento\Framework\DataObject;

/**
 * Model Language
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Language extends DataObject implements LanguageInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData(static::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name)
    {
        return $this->setData(static::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getLevel(): ?string
    {
        return $this->getData(static::LEVEL);
    }

    /**
     * @inheritDoc
     */
    public function setLevel(string $level)
    {
        return $this->setData(static::LEVEL, $level);
    }
}