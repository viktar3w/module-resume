<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model;

use Victor3w\Resume\Api\Data\ResponseGenerateInterfaceFactory;
use Victor3w\Resume\Api\Data\ResponseGenerateInterface;
use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Model\Generate\Messenger;
use Victor3w\Resume\Api\GenerateInterface;

/**
 * Model Generate
 * @package Victor3w\Resume\Model
 */
class Generate
{
    /** @var GenerateInterface */
    protected GenerateInterface $generateInterface;

    /** @var Messenger */
    protected Messenger $messenger;

    /** @var ResponseGenerateInterfaceFactory */
    protected ResponseGenerateInterfaceFactory $responseGenerateFactory;

    /**
     * @param GenerateInterface $generateInterface
     * @param Messenger $messenger
     * @param ResponseGenerateInterfaceFactory $responseGenerateFactory
     */
    public function __construct(
        GenerateInterface $generateInterface,
        Messenger $messenger,
        ResponseGenerateInterfaceFactory $responseGenerateFactory
    ) {
        $this->generateInterface = $generateInterface;
        $this->messenger = $messenger;
        $this->responseGenerateFactory = $responseGenerateFactory;
    }

    /**
     * @param ResumeInterface $resume
     * @return ResponseGenerateInterface
     */
    public function generateResume(ResumeInterface $resume)
    {
        $response = $this->responseGenerateFactory->create();
        $pdf = $this->generateInterface->getPdf($resume);
        if ($pdf) {
            return $pdf->Output('resume.pdf', 'I');
        }
        $response->setError(
            !empty($this->messenger->getMessages($this->messenger::ERROR_TYPE))
        );
        $response->setMessage(
            $response->getError()
                ? implode("\n", $this->messenger->getMessages($this->messenger::ERROR_TYPE))
                : __("PDF wasn't generated!")->getText()
        );
        return $response;
    }
}
