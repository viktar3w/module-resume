<?php

namespace Victor3w\Resume\Api\Data;

/**
 * Interface ResumeInterface
 * @package Victor3w\Resume\Api\Data
 */
interface ResumeInterface
{
    public const RESUME_FORM = 'resume';
    public const PHOTO = 'photo';
    public const FIRSTNAME = 'firstname';
    public const LASTNAME = 'lastname';
    public const TEMPlATE = 'template';
    public const EMAIL = 'email';
    public const PHONE = 'phone';
    public const LOCATION = 'location';

    public const DEFAULT_TEMPLATE = 'default';

    /**
     * @return FileInterface
     */
    public function getPhoto(): ?FileInterface;

    /**
     * @param FileInterface $file
     * @return self
     */
    public function setPhoto(FileInterface $file);

    /**
     * @return string
     */
    public function getFirstname(): string;

    /**
     * @param string $firstname
     * @return self
     */
    public function setFirstname(string $firstname);

    /**
     * @return string
     */
    public function getLastname(): string;

    /**
     * @param string $lastname
     * @return self
     */
    public function setLastname(string $lastname);

    /**
     * @return string
     */
    public function getTemplate(): string;

    /**
     * @param string $template
     * @return self
     */
    public function setTemplate(string $template);

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email);

    /**
     * @return string|null
     */
    public function getPhone(): ?string;

    /**
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone);

    /**
     * @return string|null
     */
    public function getLocation(): ?string;

    /**
     * @param string $location
     * @return self
     */
    public function setLocation(string $location);

    /**
     * @return \Victor3w\Resume\Api\Data\AdditionInterface[]
     */
    public function getAdditions(): array;

    /**
     * @param array $additions
     * @return self
     */
    public function setAdditions(array $additions);

    /**
     * @return \Victor3w\Resume\Api\Data\LanguageInterface[]
     */
    public function getLanguages(): array;

    /**
     * @param array $languages
     * @return self
     */
    public function setLanguages(array $languages);

    /**
     * @return \Victor3w\Resume\Api\Data\ExperienceInterface[]
     */
    public function getExperiences(): array;

    /**
     * @param array $experiences
     * @return self
     */
    public function setExperiences(array $experiences);

    /**
     * @return \Victor3w\Resume\Api\Data\EducationInterface[]
     */
    public function getEducation(): array;

    /**
     * @param array $education
     * @return self
     */
    public function setEducation(array $education);

    /**
     * @return \Victor3w\Resume\Api\Data\SkillInterface[]
     */
    public function getSkills(): array;

    /**
     * @param array $skills
     * @return self
     */
    public function setSkills(array $skills);
}
