<?php

declare(strict_types=1);

namespace Victor3w\Resume\Model\Generate\Filter;

use Victor3w\Resume\Api\Data\FileInterfaceFactory;
use Victor3w\Resume\Api\Data\ResumeInterface;
use Victor3w\Resume\Api\FilterInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Filter PhotoField
 * @package Victor3w\Resume\Model\Generate\Filter
 */
class PhotoField implements FilterInterface
{
    /** @var FileInterfaceFactory */
    private FileInterfaceFactory $fileDataFactory;

    /** @var RequestInterface */
    private RequestInterface $request;

    /**
     * @param FileInterfaceFactory $fileDataFactory
     * @param RequestInterface $request
     */
    public function __construct(
        FileInterfaceFactory $fileDataFactory,
        RequestInterface $request
    ) {
        $this->fileDataFactory = $fileDataFactory;
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function filter(ResumeInterface $resume): void
    {
        $files = $this->request->getFiles($resume::RESUME_FORM);
        if (!$files || empty($files[$resume::PHOTO])) {
            return;
        }
        $fileData = $this->fileDataFactory->create();
        $fileData->setName($files[$resume::PHOTO][$fileData::NAME] ?? '');
        $fileData->setType($files[$resume::PHOTO][$fileData::TYPE] ?? '');
        $fileData->setTmpName($files[$resume::PHOTO][$fileData::TMP_NAME] ?? '');
        $fileData->setError($files[$resume::PHOTO][$fileData::ERROR] ?? 0);
        $fileData->setSize($files[$resume::PHOTO][$fileData::SIZE] ?? 0);
        if ($fileData->getTmpName()
            && $fileData->getSize() > 0
            && $fileData->getError() === UPLOAD_ERR_OK) {
            $resume->setPhoto($fileData);
        }
    }
}