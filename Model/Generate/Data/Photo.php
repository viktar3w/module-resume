<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\FileInterface;
use Magento\Framework\DataObject;

/**
 * Model Photo
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Photo extends DataObject implements FileInterface
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
    public function getTmpName(): ?string
    {
        return $this->getData(static::TMP_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setTmpName(string $tmpName)
    {
        return $this->setData(static::TMP_NAME, $tmpName);
    }

    /**
     * @inheritDoc
     */
    public function getError(): int
    {
        return $this->getData(static::ERROR) ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function setError(int $error)
    {
        return $this->setData(static::ERROR, $error);
    }

    /**
     * @inheritDoc
     */
    public function getSize(): int
    {
        return $this->getData(static::SIZE) ?? 0;
    }

    /**
     * @inheritDoc
     */
    public function setSize(int $size)
    {
        return $this->setData(static::SIZE, $size);
    }
}