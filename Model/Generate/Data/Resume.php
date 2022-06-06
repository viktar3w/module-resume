<?php

namespace Victor3w\Resume\Model\Generate\Data;

use Victor3w\Resume\Api\Data\AdditionInterface;
use Victor3w\Resume\Api\Data\EducationInterface;
use Victor3w\Resume\Api\Data\ExperienceInterface;
use Victor3w\Resume\Api\Data\FileInterface;
use Victor3w\Resume\Api\Data\LanguageInterface;
use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\Data\SkillInterface;
use Magento\Framework\DataObject;

/**
 * Model Resume
 * @package Victor3w\Resume\Model\Generate\Data
 */
class Resume extends DataObject implements ResumeInterface
{
    /**
     * @inheritDoc
     */
    public function getPhoto(): ?FileInterface
    {
        return $this->getData(static::PHOTO);
    }

    /**
     * @inheritDoc
     */
    public function setPhoto(FileInterface $file)
    {
        return $this->setData(static::PHOTO, $file);
    }

    /**
     * @inheritDoc
     */
    public function getFirstname(): string
    {
        return $this->getData(static::FIRSTNAME);
    }

    /**
     * @inheritDoc
     */
    public function setFirstname(string $firstname)
    {
        return $this->setData(static::FIRSTNAME, $firstname);
    }

    /**
     * @inheritDoc
     */
    public function getLastname(): string
    {
        return $this->getData(static::LASTNAME);
    }

    /**
     * @inheritDoc
     */
    public function setLastname(string $lastname)
    {
        return $this->setData(static::LASTNAME, $lastname);
    }

    /**
     * @inheritDoc
     */
    public function getTemplate(): string
    {
        return $this->getData(static::TEMPlATE);
    }

    /**
     * @inheritDoc
     */
    public function setTemplate(string $template)
    {
        return $this->setData(static::TEMPlATE, $template);
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): string
    {
        return $this->getData(static::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail(string $email)
    {
        return $this->setData(static::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getPhone(): ?string
    {
        return $this->getData(static::PHONE);
    }


    /**
     * @inheritDoc
     */
    public function setPhone(string $phone)
    {
        return $this->setData(static::PHONE, $phone);
    }

    /**
     * @inheritDoc
     */
    public function getLocation(): ?string
    {
        return $this->getData(static::LOCATION);
    }

    /**
     * @inheritDoc
     */
    public function setLocation(string $location)
    {
        return $this->setData(static::LOCATION, $location);
    }

    /**
     * @inheritDoc
     */
    public function getAdditions(): array
    {
        return $this->getData(AdditionInterface::ADDITIONS) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setAdditions(array $additions)
    {
        return $this->setData(AdditionInterface::ADDITIONS, $additions);
    }

    /**
     * @inheritDoc
     */
    public function getLanguages(): array
    {
        return $this->getData(LanguageInterface::LANGUAGES) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setLanguages(array $languages)
    {
        return $this->setData(LanguageInterface::LANGUAGES, $languages);
    }

    /**
     * @inheritDoc
     */
    public function getExperiences(): array
    {
        return $this->getData(ExperienceInterface::EXPERIENCES) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setExperiences(array $experiences)
    {
        return $this->setData(ExperienceInterface::EXPERIENCES, $experiences);
    }

    /**
     * @inheritDoc
     */
    public function getEducation(): array
    {
        return $this->getData(EducationInterface::EDUCATION) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setEducation(array $education)
    {
        return $this->setData(EducationInterface::EDUCATION, $education);
    }

    /**
     * @inheritDoc
     */
    public function getSkills(): array
    {
        return $this->getData(SkillInterface::SKILLS) ?? [];
    }

    /**
     * @inheritDoc
     */
    public function setSkills(array $skills)
    {
        return $this->setData(SkillInterface::SKILLS, $skills);
    }
}