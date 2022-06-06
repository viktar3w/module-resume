<?php

declare(strict_types=1);

namespace Victor3w\Resume\Api;

/**
 * Interface PdfWriterInterface
 * @package Victor3w\Resume\Api
 */
interface PdfWriterInterface
{
    /**
     * @param string $name
     * @param string $dest
     * @return mixed
     */
    public function Output(string $name, string $dest);
}