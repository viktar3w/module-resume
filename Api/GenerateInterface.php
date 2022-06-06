<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api;

use Victor3w\Resume\Model\PdfWriter;
use Victor3w\Resume\Api\Data\ResumeInterface;

/**
 * Interface GenerateInterface
 * @package Victor3w\Resume\Api
 */
interface GenerateInterface
{
    public const DEFAULT_LOGO = 'Victor3w_Resume::image/logo/default_logo.png';
    public const ADDRESS_LOGO = 'Victor3w_Resume::image/logo/address_logo.png';
    public const EMAIL_LOGO = 'Victor3w_Resume::image/logo/email_logo.png';
    public const PHONE_LOGO = 'Victor3w_Resume::image/logo/phone_logo.png';
    public const ADDITION_LINK_LOGO = 'Victor3w_Resume::image/logo/additional-link.png';
    public const DOCKER_LOGO = 'Victor3w_Resume::image/logo/docker.png';
    public const GITHUB_LOGO = 'Victor3w_Resume::image/logo/github.png';
    public const GITLAB_LOGO = 'Victor3w_Resume::image/logo/gitlab.png';
    public const SKYPE_LOGO = 'Victor3w_Resume::image/logo/skype.png';
    public const LINKEDIN_LOGO = 'Victor3w_Resume::image/logo/linkedin.png';

    public const PADDING_LEFT = 10;
    public const PADDING_TOP = 10;
    public const PADDING_RIGHT = 10;
    public const SOCIAL_LOGO_HEIGHT = 3;
    public const SOCIAL_LOGO_WEIGHT = 3;
    public const LEFT_PART_WIDTH = 60;
    public const MARGIN_LEFT = 5;
    public const GREY_COLOR = [201, 201, 201];
    public const FONT_FAMILY = 'freeserif';
    public const USUAL_FONT_SIZE = 13;
    public const SMALL_FONT_SIZE = 10;

    /**
     * @param ResumeInterface $resume
     * @return PdfWriter|null
     */
    public function getPdf(ResumeInterface $resume): ?PdfWriterInterface;
}
