<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\AdditionInterface;
use Magento\Framework\DataObject;

/**
 * Model Addition
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Addition extends DataObject implements AdditionInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): ?string
    {
        return $this->getData(static::TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type)
    {
        return $this->setData(static::TYPE, $type);
    }

    /**
     * @inheritDoc
     */
    public function getLink(): ?string
    {
        return $this->getData(static::LINK);
    }

    /**
     * @inheritDoc
     */
    public function setLink(string $link)
    {
        return $this->setData(static::LINK, $link);
    }
}