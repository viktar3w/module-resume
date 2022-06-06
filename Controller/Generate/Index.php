<?php

declare(strict_types=1);

namespace Victor3w\Resume\Controller\Generate;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Action Index
 * @package Victor3w\Resume\Controller\Generate
 */
class Index implements HttpGetActionInterface
{
    /** @var PageFactory */
    protected PageFactory $pageFactory;

    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
