<?php

declare(strict_types=1);

namespace Victor3w\Resume\Block\Generate;

use Victor3w\Resume\Api\GenerateInterface;
use Magento\Framework\View\Element\Template;

/**
 * Block Index
 * @package Victor3w\Resume\Block\Generate
 */
class Index extends Template
{
    /**
     * @return string
     */
    public function getDefaultLogoUrl()
    {
        return $this->_assetRepo->getUrlWithParams(
            GenerateInterface::DEFAULT_LOGO,
            [
                '_secure' => $this->_request->isSecure(),
                'area' => 'frontend'
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function getJsLayout()
    {
        if ($this->jsLayout) {
            $this->jsLayout['components']['resume_generate']['config']['defaultLogo'] = $this->getDefaultLogoUrl();
        }
        return parent::getJsLayout();
    }
}
