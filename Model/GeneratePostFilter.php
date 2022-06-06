<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter GeneratePostFilter
 * @package Victor3w\Resume\Model
 */
class GeneratePostFilter implements FilterInterface
{
    /**@var FilterInterface[] */
    protected array $filters;

    /**
     * @param array $filters
     */
    public function __construct(
        array $filters = []
    ) {
        $this->filters = $filters;
    }

    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        foreach ($this->filters as $filter) {
            $filter->filter($resume);
        }
    }
}