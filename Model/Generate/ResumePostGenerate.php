<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate;

use Victor3w\Resume\Api\FilterInterface;
use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\PdfWriterInterface;
use Victor3w\Resume\Api\ValidatorInterface;
use Victor3w\Resume\Api\GenerateInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Generate ResumePostGenerate
 * @package Victor3w\Resume\Model\Generate
 */
class ResumePostGenerate implements GenerateInterface
{
    /** @var RequestInterface */
    protected RequestInterface $request;

    /** @var ValidatorInterface */
    protected ValidatorInterface $validator;

    /** @var FilterInterface */
    protected FilterInterface $filter;

    /**@var GenerateInterface[] */
    protected array $templates;

    /**
     * @param RequestInterface $request
     * @param ValidatorInterface $validator
     * @param FilterInterface $filter
     * @param array $templates
     */
    public function __construct(
        RequestInterface $request,
        ValidatorInterface $validator,
        FilterInterface $filter,
        array $templates = []
    ) {
        $this->request = $request;
        $this->validator = $validator;
        $this->filter = $filter;
        $this->templates = $templates;
    }

    /**
     * @inheritDoc
     */
    public function getPdf(ResumeInterface $resume): ?PdfWriterInterface
    {
        $this->filter->filter($resume);
        if (!$this->validator->validate($resume)) {
            return null;
        }
        foreach ($this->templates as $key => $template) {
            if ($key === $resume->getTemplate()) {
                return $template->getPdf($resume);
            }
        }
        return null;
    }
}