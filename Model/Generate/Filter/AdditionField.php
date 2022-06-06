<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;
use Victor3w\Resume\Api\Data\AdditionInterface;

/**
 * Filter AdditionField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class AdditionField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        if (!$resume->getAdditions()) {
            return;
        }
        $filter = static function (string $field): string {
            return filter_var($field, FILTER_SANITIZE_URL);
        };
        $additions = [];
        foreach ($resume->getAdditions() as $addition) {
            $type = $addition::OTHER_TYPE;
            if (in_array($addition->getType(), $this->getTypes())) {
                $type = (int)$addition->getType();
            }
            $addition->setType((string)$type);
            $addition->setLink($filter($addition->getLink()));
            if ($addition->getLink()) {
                $additions[] = $addition;
            }
        }
        $resume->setAdditions($additions);
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return [
            AdditionInterface::SKYPE_TYPE,
            AdditionInterface::LINKEDIN_TYPE,
            AdditionInterface::GITHUB_TYPE,
            AdditionInterface::GITLAB_TYPE,
            AdditionInterface::DOCKERHUB_TYPE,
            AdditionInterface::OTHER_TYPE
        ];
    }
}