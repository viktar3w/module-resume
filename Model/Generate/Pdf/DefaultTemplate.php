<?php

namespace Victor3w\Resume\Model\Generate\Pdf;

use Victor3w\Resume\Api\PdfWriterInterface;
use Victor3w\Resume\Api\Data\DateIntervalInterface;
use Victor3w\Resume\Api\Data\LanguageInterface;
use Victor3w\Resume\Api\Data\SkillInterface;
use Victor3w\Resume\Model\PdfWriter;
use Victor3w\Resume\Model\PdfWriterFactory;
use Victor3w\Resume\Api\Data\ResumeInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Asset\Repository as AssetRepository;

/**
 * Pdf DefaultTemplate
 * @package Victor3w\Resume\Model\Generate\Pdf
 */
class DefaultTemplate extends CommonTemplate
{
    /** @var PdfWriterFactory */
    protected PdfWriterFactory $pdfWriterFactory;

    /** @var ResumeInterface|null */
    protected ?ResumeInterface $resume = null;

    /** @var PdfWriter|null */
    protected ?PdfWriter $pdf = null;
    
    public function __construct(
        PdfWriterFactory $pdfWriterFactory,
        AssetRepository $assetRepository,
        RequestInterface $request
    ) {
        $this->pdfWriterFactory = $pdfWriterFactory;
        parent::__construct($assetRepository, $request);
    }

    /**
     * @inheritDoc
     */
    public function getPdf(ResumeInterface $resume): ?PdfWriterInterface
    {
        $this->resume = $resume;
        $this->pdf = $this->pdfWriterFactory->create();
        $this->pdf->setPrintFooter(false);
        $this->pdf->setTitle('CV');
        $this->pdf->setAuthor(
            sprintf(
                '%s %s',
                $this->mbUcfirst(mb_strtolower($this->resume->getFirstname())),
                $this->mbUcfirst(mb_strtolower($this->resume->getLastname()))
            ),
        );
        $this->pdf->SetMargins(static::PADDING_LEFT, static::PADDING_TOP, static::PADDING_RIGHT);
        $this->pdf->AddPage();
        $this->initLeftPart();
        $this->initRightPart();
        return $this->pdf;
    }

    /**
     * @return PdfWriter
     */
    protected function initLeftPart(): PdfWriter
    {
        $this->addLogo();
        $this->addContactData();
        $this->addSkills();
        $this->addLanguages();
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addLogo()
    {
        $this->pdf->Image(
            $this->getLogo(),
            static::MARGIN_LEFT,
            15,
            static::LEFT_PART_WIDTH - static::PADDING_LEFT,
            50,
            $this->getLogoType()
        );
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addContactData()
    {
        $this->pdf->Ln(10);
        $this->pdf->SetFont(static::FONT_FAMILY, '', static::SMALL_FONT_SIZE);
        if ($this->resume->getPhone()) {
            $this->pdf->Cell(
                static::LEFT_PART_WIDTH - static::PADDING_LEFT,
                static::SMALL_FONT_SIZE,
                "+{$this->resume->getPhone()}",
                0,
                0,
                'L',
                false,
                "tel:+{$this->resume->getPhone()}"
            );
            $this->pdf->Image(
                $this->getViewFileUrl(static::PHONE_LOGO),
                static::MARGIN_LEFT,
                $this->pdf->GetY() + 3,
                static::SOCIAL_LOGO_WEIGHT,
                static::SOCIAL_LOGO_HEIGHT,
                'png'
            );
            $this->pdf->SetY($this->pdf->GetY() + 10);
        }
        $defaultY = $this->pdf->GetY();
        $this->pdf->MultiCell(
            static::LEFT_PART_WIDTH - static::PADDING_LEFT,
            10,
            $this->resume->getEmail(),
            0,
            'L'
        );
        $this->pdf->Image(
            $this->getViewFileUrl(static::EMAIL_LOGO),
            static::MARGIN_LEFT,
            $defaultY + 1,
            static::SOCIAL_LOGO_WEIGHT,
            static::SOCIAL_LOGO_HEIGHT,
            'png'
        );
        if ($this->resume->getLocation()) {
            $defaultY = $this->pdf->GetY();
            $this->pdf->MultiCell(
                static::LEFT_PART_WIDTH - static::PADDING_LEFT,
                10,
                $this->resume->getLocation(),
                0,
                'L'
            );
            $this->pdf->Image(
                $this->getViewFileUrl(static::ADDRESS_LOGO),
                static::MARGIN_LEFT,
                $defaultY,
                static::SOCIAL_LOGO_WEIGHT,
                static::SOCIAL_LOGO_HEIGHT,
                'png'
            );
        }
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addSkills()
    {
        if (!$this->resume->getSkills()) {
            return $this->pdf;
        }
        $this->pdf->Ln(10);
        $this->pdf->SetFont(static::FONT_FAMILY, 'B', 14);
        $y = $this->pdf->GetY() + 7;
        $this->pdf->Cell(25, 14, 'Skills', 0, 1, "R");
        $this->pdf->Line(12, $y, 17, $y, ['color' => static::GREY_COLOR, 'width' => 0.5]);
        $this->pdf->Line(40, $y, 45, $y, ['color' => static::GREY_COLOR, 'width' => 0.5]);
        $skills = array_map(function (SkillInterface $skill) {
            return $skill->getSkill();
        }, $this->resume->getSkills());
        $this->pdf->SetFont(static::FONT_FAMILY, '', static::USUAL_FONT_SIZE);
        $this->pdf->MultiCell(
            static::LEFT_PART_WIDTH - static::PADDING_LEFT,
            4,
            implode(', ', $skills),
            0,
            'C',
            false,
            1,
            static::MARGIN_LEFT
        );
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addLanguages()
    {
        if (!$this->resume->getLanguages()) {
            return $this->pdf;
        }
        $this->pdf->Ln(10);
        $this->pdf->SetFont(static::FONT_FAMILY, 'B', 14);
        $y = $this->pdf->GetY() + 7;
        $this->pdf->Cell(30, 14, 'Languages', 0, 1, "R");
        $this->pdf->Line(7, $y, 12, $y, ['color' => static::GREY_COLOR, 'width' => 0.5]);
        $this->pdf->Line(44, $y, 49, $y, ['color' => static::GREY_COLOR, 'width' => 0.5]);
        $skills = array_map(static function (LanguageInterface $language) {
            return sprintf(
                '%s - %s',
                mb_strtolower($language->getName()), mb_strtolower($language->getLevel())
            );
        }, $this->resume->getLanguages());
        $this->pdf->SetFont(static::FONT_FAMILY, '', static::USUAL_FONT_SIZE);
        $this->pdf->MultiCell(
            static::LEFT_PART_WIDTH - static::PADDING_LEFT,
            10,
            implode(', ', $skills),
            0,
            'C',
            false,
            1,
            static::MARGIN_LEFT
        );
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function initRightPart()
    {
        $this->pdf->setPage(1);
        $this->pdf->setY(15);
        $this->addName();
        $this->addExperience();
        $this->addEducation();
        $this->addAdditionLink();
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addName()
    {
        $this->pdf->setX(static::LEFT_PART_WIDTH);
        $this->pdf->setFont(static::FONT_FAMILY, 'B', 20);
        $this->pdf->MultiCell(
            $this->getRightWidth(),
            10,
            sprintf(
                '%s %s',
                $this->mbUcfirst(mb_strtolower($this->resume->getFirstname())),
                $this->mbUcfirst(mb_strtolower($this->resume->getLastname()))
            ),
            0,
            'C'
        );
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addExperience()
    {
        $lineX = ($this->getRightWidth()) - (($this->getRightWidth() / 2) - 37);
        $this->addTitleOnRightPart('Experiences', $lineX);
        foreach ($this->resume->getExperiences() as $experience) {
            $this->addDateBox($experience);
            $this->pdf->setFont(static::FONT_FAMILY, '', static::SMALL_FONT_SIZE);
            $this->pdf->MultiCell(
                45,
                4,
                $experience->getCompany(),
                'R',
                'R',
                false,
                0,
            );
            $this->pdf->MultiCell(
                45,
                4,
                $experience->getPosition(),
                0,
                'L'
            );
            $this->pdf->Ln(5);
            $this->pdf->setX(static::LEFT_PART_WIDTH + static::MARGIN_LEFT);
            $this->pdf->SetFont(static::FONT_FAMILY, '', static::USUAL_FONT_SIZE);
            $this->pdf->MultiCell(
                $this->getRightWidth() + static::MARGIN_LEFT,
                0,
                $experience->getResponsibility(),
                0,
                'L',
            );
            $this->pdf->Ln(5);
        }
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addEducation()
    {
        $lineX = ($this->getRightWidth()) - (($this->getRightWidth() / 2) - 40);
        $this->addTitleOnRightPart('Education', $lineX, 35);
        foreach ($this->resume->getEducation() as $education) {
            $this->addDateBox($education);
            $this->pdf->setFont(static::FONT_FAMILY, '', static::SMALL_FONT_SIZE);
            $this->pdf->MultiCell(
                45,
                4,
                $education->getInstitution(),
                0,
                'R'
            );
            $this->pdf->Ln(5);
            $this->pdf->setX(static::LEFT_PART_WIDTH + static::MARGIN_LEFT);
            $this->pdf->SetFont(static::FONT_FAMILY, '', static::USUAL_FONT_SIZE);
            $this->pdf->MultiCell(
                $this->getRightWidth() + static::MARGIN_LEFT,
                0,
                $education->getResponsibility(),
                0,
                'L',
            );
            $this->pdf->Ln(5);
        }
        return $this->pdf;
    }

    /**
     * @return PdfWriter|null
     */
    protected function addAdditionLink()
    {
        if (!$this->resume->getAdditions()) {
            return $this->pdf;
        }
        $lineX = ($this->getRightWidth()) - (($this->getRightWidth() / 2) - 35);
        $this->addTitleOnRightPart('Addition Links', $lineX, 45);
        foreach ($this->resume->getAdditions() as $addition) {
            $this->pdf->Image(
                $this->getAdditionLinkLogo($addition->getType()),
                static::LEFT_PART_WIDTH + static::MARGIN_LEFT,
                null,
                5,
                5,
                'png'
            );
            $this->pdf->setX(static::LEFT_PART_WIDTH + static::MARGIN_LEFT);
            $this->pdf->SetFont(static::FONT_FAMILY, '', static::USUAL_FONT_SIZE);
            $this->pdf->MultiCell(
                $this->getRightWidth() + static::MARGIN_LEFT + static::SOCIAL_LOGO_WEIGHT,
                4,
                $addition->getLink(),
                0,
                'L',
                0,
                1,
                $this->pdf->getX() + static::MARGIN_LEFT + 5
            );
            $this->pdf->Ln(5);
        }
        return $this->pdf;
    }

    /**
     * @param DateIntervalInterface $date
     * @return PdfWriter|null
     */
    protected function addDateBox(DateIntervalInterface $date)
    {
        $this->pdf->setX(static::LEFT_PART_WIDTH + static::MARGIN_LEFT);
        $dateTo = ($date->getTo()) ? $date->getTo() : __('now');
        $date = ($date->getFrom() || $date->getTo())
            ? sprintf('%s - %s', $date->getFrom(), $dateTo)
            : '';
        $this->pdf->setFont(static::FONT_FAMILY, 'I', static::SMALL_FONT_SIZE);
        $this->pdf->Cell(40, 4, $date, 0, 0, 'L');
        return $this->pdf;
    }

    /**
     * @return float
     */
    protected function getRightWidth(): float
    {
        return $this->pdf->getPageWidth() - static::LEFT_PART_WIDTH - static::PADDING_RIGHT - static::PADDING_LEFT;
    }

    /**
     * @param string $title
     * @param float $lineX
     * @param float $titleWight
     * @return PdfWriter|null
     */
    protected function addTitleOnRightPart(string $title, float $lineX, float $titleWight = 40)
    {
        $this->pdf->setX(static::LEFT_PART_WIDTH);
        $this->pdf->SetFont(static::FONT_FAMILY, 'B', 14);
        $y = $this->pdf->GetY() + 7;
        $this->pdf->Cell($this->getRightWidth(), 14, __($title), 0, 1, "C");
        $this->pdf->Line(
            $lineX,
            $y,
            $lineX + static::MARGIN_LEFT,
            $y,
            ['color' => static::GREY_COLOR, 'width' => 0.5]
        );
        $this->pdf->Line(
            $lineX + $titleWight,
            $y,
            $lineX + static::MARGIN_LEFT + $titleWight,
            $y,
            ['color' => static::GREY_COLOR, 'width' => 0.5]
        );
        return $this->pdf;
    }
}
