<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface AdditionInterface
 * @package Victor3w\Resume\Api\Data
 */
interface AdditionInterface
{
    public const OTHER_TYPE = 0;
    public const SKYPE_TYPE = 1;
    public const LINKEDIN_TYPE = 2;
    public const GITHUB_TYPE = 3;
    public const GITLAB_TYPE = 4;
    public const DOCKERHUB_TYPE = 5;

    public const TYPE = 'type';
    public const LINK = 'link';
    public const ADDITIONS = 'additions';
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
    public function getLink(): ?string;

    /**
     * @param string $link
     * @return self
     */
    public function setLink(string $link);
}