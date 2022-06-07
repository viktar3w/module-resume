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
     * @inheritDoc
     */
    public function getJsLayout()
    {
        if ($this->jsLayout) {
            $defaultLogo = [
                'path' => $this->_assetRepo
                    ->getUrlWithParams(
                        '',
                        [
                            '_secure' => $this->_request->isSecure(),
                            'area' => 'frontend'
                        ]
                    ),
                'logo' => GenerateInterface::DEFAULT_LOGO,
                'linkedin' => GenerateInterface::LINKEDIN_LOGO,
                'github' => GenerateInterface::GITHUB_LOGO,
                'addition' => GenerateInterface::ADDITION_LINK_LOGO,
                'phone' => GenerateInterface::PHONE_LOGO,
                'email' => GenerateInterface::EMAIL_LOGO,
                'address' => GenerateInterface::ADDRESS_LOGO,
            ];
            $this->jsLayout['components']['resume_generate']['config']['defaultLogo'] = $defaultLogo;
        }
        return parent::getJsLayout();
    }
}
