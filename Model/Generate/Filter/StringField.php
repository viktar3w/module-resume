<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;

/**
 * Filter StringField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class StringField implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $filter = static function (string $field): string {
            return trim(filter_var(htmlspecialchars($field), FILTER_SANITIZE_STRING));
        };
        $resume->setFirstname($filter($resume->getFirstname()));
        $resume->setLastname($filter($resume->getLastname()));
        $resume->setLocation($filter($resume->getLocation() ?? ''));
        if ($resume->getLanguages()) {
            $languages = [];
            foreach ($resume->getLanguages() as $language) {
                $language->setName($filter($language->getName()));
                $language->setLevel($filter($language->getLevel()));
                if ($language->getName() && $language->getLevel()) {
                    $languages[] = $language;
                }
            }
            $resume->setLanguages($languages);
        }
        if ($resume->getExperiences()) {
            foreach ($resume->getExperiences() as $experience) {
                $experience->setCompany($filter($experience->getCompany()));
                $experience->setPosition($filter($experience->getPosition()));
                $experience->setResponsibility($filter($experience->getResponsibility()));
            }
        }
        if ($resume->getEducation()) {
            $education = [];
            foreach ($resume->getEducation() as $item) {
                $item->setInstitution($filter($item->getInstitution()));
                $item->setResponsibility($filter($item->getResponsibility()));
                if ($item->getInstitution() && $item->getResponsibility()) {
                    $education[] = $item;
                }
            }
            $resume->setEducation($education);
        }
        if ($resume->getSkills()) {
            $skills = [];
            foreach ($resume->getSkills() as $skill) {
                $skill->setSkill($filter($skill->getSkill()));
                if ($skill->getSkill()) {
                    $skills[] = $skill;
                }
            }
            $resume->setSkills($skills);
        }
    }
}