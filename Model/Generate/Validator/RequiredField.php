<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Validator;

use Victor3w\Resume\Api\Data\ResumeInterface;

/**
 * Validator RequiredField
 * @package Victor3w\Resume\Model\Generate\Validator
 */
class RequiredField extends CommonField
{
    public const REQUIRE_FIELD_MESSAGE = '%1 is require field. Please, fill it!';
    public const MAX_LENGTH_MESSAGE = 'Max length of %1 is %2 letters.';
    public const MIN_LENGTH_MESSAGE = 'Min length of %1 is %2 letters.';
    public const TYPE_MESSAGE = '%1 should be type of %2. Please, check it!';
    public const PHONE_MAX_LENGTH = 18;
    public const PHONE_MIN_LENGTH = 7;
    public const INPUT_TEXT_MAX_LENGTH = 50;

    /**
     * @inheritDoc
     */
    public function validate(ResumeInterface $resume): bool
    {
        $this->messages = [];
        if (!$resume->getFirstname()) {
            $this->messages[] = str_replace('%1', 'Firstname', static::REQUIRE_FIELD_MESSAGE);
        } elseif (mb_strlen($resume->getFirstname(), 'UTF-8') > 60) {
            $this->messages[] = str_replace(['%1', '%2'], ['Firstname', 60], static::MAX_LENGTH_MESSAGE);
        }
        if (!$resume->getLastname()) {
            $this->messages[] = str_replace('%1', 'Lastname', static::REQUIRE_FIELD_MESSAGE);
        } elseif (mb_strlen($resume->getLastname(), 'UTF-8') > 60) {
            $this->messages[] = str_replace(['%1', '%2'], ['Lastname', 60], static::MAX_LENGTH_MESSAGE);
        }
        if (!$resume->getEmail()) {
            $this->messages[] = str_replace('%1', 'Email', static::REQUIRE_FIELD_MESSAGE);
        } elseif (filter_var($resume->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
            $this->messages[] = str_replace(['%1', '%2'], ['Email', 'email'], static::TYPE_MESSAGE);
        }
        if ($resume->getPhone()) {
            if (strlen($resume->getPhone()) > static::PHONE_MAX_LENGTH) {
                $this->messages[] = str_replace(
                    ['%1', '%2'],
                    ['Phone', static::PHONE_MAX_LENGTH],
                    static::MAX_LENGTH_MESSAGE
                );
            } elseif (strlen($resume->getPhone()) < static::PHONE_MIN_LENGTH) {
                $this->messages[] = str_replace(
                    ['%1', '%2'],
                    ['Phone', static::PHONE_MIN_LENGTH],
                    static::MIN_LENGTH_MESSAGE
                );
            }
        }
        if ($resume->getLocation()) {
            if (mb_strlen($resume->getLocation(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                $this->messages[] = str_replace(
                    ['%1', '%2'],
                    ['Location', static::INPUT_TEXT_MAX_LENGTH],
                    static::MAX_LENGTH_MESSAGE
                );
            }
        }
        if ($resume->getLanguages()) {
            foreach ($resume->getLanguages() as $language) {
                $error = [];
                if (mb_strlen($language->getName(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $error[] = str_replace(
                        ['%1', '%2'],
                        ['Language', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                }
                if (mb_strlen($language->getLevel(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $error[] = str_replace(
                        ['%1', '%2'],
                        ['Language Level', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                }
                if ($error) {
                    $this->messages = array_merge($this->messages, $error);
                    break;
                }
            }
        }
        if ($resume->getSkills()) {
            foreach ($resume->getSkills() as $skill) {
                if (mb_strlen($skill->getSkill(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $this->messages[] = str_replace(
                        ['%1', '%2'],
                        ['Skill', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                    break;
                }
            }
        }
        if (!$resume->getExperiences()) {
            $this->messages[] = str_replace('%1', 'Experiences', static::REQUIRE_FIELD_MESSAGE);
        } else {
            foreach ($resume->getExperiences() as $experience) {
                $error = [];
                if (!$experience->getCompany()) {
                    $error[] = str_replace('%1', 'Company', static::REQUIRE_FIELD_MESSAGE);
                } elseif (mb_strlen($experience->getCompany(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $error[] = str_replace(
                        ['%1', '%2'],
                        ['Company', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                }
                if (!$experience->getPosition()) {
                    $error[] = str_replace('%1', 'Position', static::REQUIRE_FIELD_MESSAGE);
                } elseif (mb_strlen($experience->getPosition(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $error[] = str_replace(
                        ['%1', '%2'],
                        ['Position', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                }
                if (!$experience->getResponsibility()) {
                    $error[] = str_replace('%1', 'Responsibility', static::REQUIRE_FIELD_MESSAGE);
                }
                if ($error) {
                    $this->messages = array_merge($this->messages, $error);
                    break;
                }
            }
        }
        if ($resume->getEducation()) {
            foreach ($resume->getEducation() as $education) {
                $error = [];
                if (mb_strlen($education->getInstitution(), 'UTF-8') > static::INPUT_TEXT_MAX_LENGTH) {
                    $error[] = str_replace(
                        ['%1', '%2'],
                        ['Skill', static::INPUT_TEXT_MAX_LENGTH],
                        static::MAX_LENGTH_MESSAGE
                    );
                }
                if ($error) {
                    $this->messages = array_merge($this->messages, $error);
                    break;
                }
            }
        }
        return empty($this->messages);
    }
}
