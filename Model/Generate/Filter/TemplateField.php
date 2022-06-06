<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter TemplateField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class TemplateField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $template = in_array($resume->getTemplate(), $this->getTemplates())
            ? $resume->getTemplate() : ResumeInterface::DEFAULT_TEMPLATE;
        $resume->setTemplate($template);
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            ResumeInterface::DEFAULT_TEMPLATE
        ];
    }
}