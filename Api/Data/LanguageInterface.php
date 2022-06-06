<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface LanguageInterface
 * @package Victor3w\Resume\Api\Data
 */
interface LanguageInterface
{
    public const NAME = 'name';
    public const LEVEL = 'level';
    public const LANGUAGES = 'languages';

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
    public function getLevel(): ?string;

    /**
     * @param string $level
     * @return self
     */
    public function setLevel(string $level);

}