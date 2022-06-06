<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface FileInterface
 * @package Victor3w\Resume\Api\Data
 */
interface FileInterface
{
    public const NAME = 'name';
    public const TYPE = 'type';
    public const TMP_NAME = 'tmp_name';
    public const ERROR = 'error';
    public const SIZE = 'size';
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name);

    /**
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type);

    /**
     * @return string|null
     */
    public function getTmpName(): ?string;

    /**
     * @param string $tmpName
     * @return self
     */
    public function setTmpName(string $tmpName);

    /**
     * @return int
     */
    public function getError(): int;

    /**
     * @param int $error
     * @return self
     */
    public function setError(int $error);

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @param int $size
     * @return self
     */
    public function setSize(int $size);
}