<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api\Data;

/**
 * Interface DateIntervalInterface
 * @package Victor3w\Resume\Api\Data
 */
interface DateIntervalInterface
{
    public const FROM_DATE = 'from';
    public const TO_DATE = 'to';

    /**
     * @return string|null
     */
    public function getFrom(): ?string;

    /**
     * @param string $from
     * @return self
     */
    public function setFrom(string $from);

    /**
     * @return string|null
     */
    public function getTo(): ?string;

    /**
     * @param string $to
     * @return self
     */
    public function setTo(string $to);
}