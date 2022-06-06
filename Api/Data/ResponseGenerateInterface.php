<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface ResponseGenerateInterface
 * @package Victor3w\Resume\Api\Data
 */
interface ResponseGenerateInterface
{
    public const ERROR = 'error';
    public const MESSAGE = 'message';
    public const FILE_CONTENT = 'file_content';

    /**
     * @return bool
     */
    public function getError(): bool;

    /**
     * @param bool $error
     * @return self
     */
    public function setError(bool $error);

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @param string $message
     * @return self
     */
    public function setMessage(string $message);

    /**
     * @return string
     */
    public function getFileContent();

    /**
     * @param string $fileContent
     * @return self
     */
    public function setFileContent(string $fileContent);
}