<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Pdf;

use Victor3w\Resume\Api\Data\AdditionInterface;
use Victor3w\Resume\Api\GenerateInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;

/**
 * Pdf CommonTemplate
 * @package Victor3w\Resume\Model\Generate\Pdf
 */
abstract class CommonTemplate implements GenerateInterface
{
    /** @var AssetRepository */
    protected AssetRepository $assetRepository;

    /** @var RequestInterface */
    protected RequestInterface $request;

    /** @var string */
    protected string $logo = '';

    /**
     * @param AssetRepository $assetRepository
     * @param RequestInterface $request
     */
    public function __construct(
        AssetRepository $assetRepository,
        RequestInterface $request
    ) {
        $this->assetRepository = $assetRepository;
        $this->request = $request;
    }

    /**
     * @param string $fileId
     * @return string
     */
    protected function getViewFileUrl(
        string $fileId
    ): string {
        return $this->assetRepository->getUrlWithParams(
            $fileId,
            [
                '_secure' => $this->request->isSecure(),
                'area' => 'frontend'
            ]
        );
    }

    /**
     * @param string $str
     * @param string $encoding
     * @param bool $lower_str_end
     * @return string
     */
    protected function mbUcfirst(
        string $str,
        string $encoding = "UTF-8",
        bool $lower_str_end = false
    ): string {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = ($lower_str_end)
            ? mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding)
            : mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        return $first_letter . $str_end;
    }

    /**
     * @return string
     */
    protected function getLogo(): string
    {
        if ($this->logo) {
            return $this->logo;
        }
        $this->logo = ($this->resume->getPhoto())
            ? $this->resume->getPhoto()->getTmpName()
            : $this->getViewFileUrl(static::DEFAULT_LOGO);
        $this->pdf->setY($this->pdf->getY() + static::LEFT_PART_WIDTH - static::PADDING_LEFT);
        return $this->logo;
    }

    /**
     * @return string
     */
    protected function getLogoType(): string
    {
        $fileType = strstr($this->getImageMimeType($this->getLogo()), '/');
        return trim($fileType ?: '', '/');
    }

    /**
     * @param string $image
     * @return string|null
     */
    protected function getImageMimeType(
        string $image
    ): string {
        $mimes = [
            IMAGETYPE_GIF => "image/gif",
            IMAGETYPE_JPEG => "image/jpg",
            IMAGETYPE_PNG => "image/png",
            IMAGETYPE_SWF => "image/swf",
            IMAGETYPE_PSD => "image/psd",
            IMAGETYPE_BMP => "image/bmp",
            IMAGETYPE_TIFF_II => "image/tiff",
            IMAGETYPE_TIFF_MM => "image/tiff",
            IMAGETYPE_JPC => "image/jpc",
            IMAGETYPE_JP2 => "image/jp2",
            IMAGETYPE_JPX => "image/jpx",
            IMAGETYPE_JB2 => "image/jb2",
            IMAGETYPE_SWC => "image/swc",
            IMAGETYPE_IFF => "image/iff",
            IMAGETYPE_WBMP => "image/wbmp",
            IMAGETYPE_XBM => "image/xbm",
            IMAGETYPE_ICO => "image/ico"
        ];
        return ($image_type = exif_imagetype($image))
            ? $mimes[$image_type] ?? ''
            : '';
    }

    /**
     * @param int $type
     * @return string
     */
    protected function getAdditionLinkLogo(
        int $type
    ): string {
        switch ($type) {
            case AdditionInterface::SKYPE_TYPE:
                $logo = static::SKYPE_LOGO;
                break;
            case AdditionInterface::LINKEDIN_TYPE:
                $logo = static::LINKEDIN_LOGO;
                break;
            case AdditionInterface::GITHUB_TYPE:
                $logo = static::GITHUB_LOGO;
                break;
            case AdditionInterface::GITLAB_TYPE:
                $logo = static::GITLAB_LOGO;
                break;
            case AdditionInterface::DOCKERHUB_TYPE:
                $logo = static::DOCKER_LOGO;
                break;
            default:
                $logo = static::ADDITION_LINK_LOGO;
        }
        return $this->getViewFileUrl($logo);
    }
}
