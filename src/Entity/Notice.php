<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\NoticeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoticeRepository::class)
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"device": "exact"})
 */
class Notice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $pdf_file;

    /**
     * @ORM\OneToOne(targetEntity=Device::class, inversedBy="notice", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $device;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPdfFile(): ?string
    {
        return $this->pdf_file;
    }

    public function setPdfFile(string $pdf_file): self
    {
        $this->pdf_file = $pdf_file;

        return $this;
    }

    public function getDevice(): ?Device
    {
        return $this->device;
    }

    public function setDevice(Device $device): self
    {
        $this->device = $device;

        return $this;
    }
}
