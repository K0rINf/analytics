<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\Blameable;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    use Blameable;
    use Timestampable;

    const ITEM_STATUS_DRAFT = 0;
    const ITEM_STATUS_PROCESS = 1;
    const ITEM_STATUS_SUCCESS = 2;
    const ITEM_STATUS_FAIL = 3;
    const ITEM_STATUS_SKIP = 4;

    const STATUS_DRAFT = 0; // Черновик
    const STATUS_BEGIN_PROCESS = 1; //Парсинг файла
    const STATUS_FAIL_PROCESS = 2; // Неудачная обработка файла
    const STATUS_SUCCESS_PROCESS = 3; // Успешная обработка файла
    const STATUS_BEGIN_CALCULATE = 4; // Процесс расчета
    const STATUS_FAIL_CALCULATE = 5; // Неудачная попытка расчета
    const STATUS_SUCCESS_CALCULATE = 6; // Расчет сформирован
    const STATUS_ARCHIVE_CALCULATE = 7; // Архив

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $report;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $error;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $algorithm;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Template", inversedBy="application", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $template;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(Template $template): self
    {
        $this->template = $template;

        return $this;
    }
}
