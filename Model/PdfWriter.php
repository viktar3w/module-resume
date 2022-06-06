<?php

namespace Victor3w\Resume\Model;

use Victor3w\Resume\Api\PdfWriterInterface;
use TCPDF;

/**
 * Model PdfWriter
 * @package Victor3w\Resume\Model
 */
class PdfWriter extends TCPDF implements PdfWriterInterface
{
    /**
     * @inheritDoc
     */
    public function Header()
    {
        parent::Header();
        $this->SetFillColor(232, 232, 232);
        $this->Rect(0, 0, 60, $this->GetPageHeight(), 'F');
        $this->SetFillColor(255, 255, 255);
        $this->Rect(60, 0, $this->getPageWidth() - 60, $this->GetPageHeight(), 'F');
    }
}