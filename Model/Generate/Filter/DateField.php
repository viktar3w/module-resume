<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter DateField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class DateField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $filter = static function (string $field): string {
            $preparedField = filter_var($field, FILTER_SANITIZE_NUMBER_INT);
            return strlen($preparedField) === 10 ? $preparedField : '';
        };
        if ($resume->getEducation()) {
            foreach ($resume->getEducation() as $education) {
                $education->setFrom($filter($education->getFrom() ?? ''));
                $education->setTo($filter($education->getTo() ?? ''));
            }
        }
        if ($resume->getExperiences()) {
            foreach ($resume->getExperiences() as $experience) {
                $experience->setFrom($filter($experience->getFrom() ?? ''));
                $experience->setTo($filter($experience->getTo() ?? ''));
            }
        }
    }
}