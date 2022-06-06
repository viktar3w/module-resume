<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate;

/**
 * Class Messenger
 * @package Victor3w\Resume\Model\Generate
 */
class Messenger
{
    public const ERROR_TYPE = 'error';

    /** @var array|array[] */
    protected array $types = [
        self::ERROR_TYPE => []
    ];

    /**
     * @param string $key
     * @param string $message
     * @return void
     */
    public function addError(string $key, string $message): void
    {
        $this->types[self::ERROR_TYPE][$key] = __($message);
    }

    /**
     * @param string $type
     * @return void
     */
    public function clear(string $type)
    {
        $this->types[$type] = [];
    }

    /**
     * @param string $type
     * @return array
     */
    public function getMessages(string $type): array
    {
        return $this->types[$type] ?? [];
    }
}
