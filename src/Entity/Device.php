<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DeviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
 * @Vich\Uploadable
 * @ApiResource()
 * @ApiFilter(SearchFilter::class)
 * @ApiFilter(OrderFilter::class)
 */
class Device
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Un nom d'appareil est obligatoire")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Une référence est obligatoire")
     */
    private $reference;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Une image de l'appareil est obligatoire")
     */
    private $illustration;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="device_image", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\OneToMany(targetEntity=Alarm::class, mappedBy="device", cascade={"persist", "remove"})
     */
    private $alarms;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="device", cascade={"persist", "remove"})
     */
    private $maintenances;

    /**
     * @ORM\OneToOne(targetEntity=Notice::class, mappedBy="device", cascade={"persist", "remove"})
     */
    private $notice;

    public function __construct()
    {
        $this->alarms = new ArrayCollection();
        $this->maintenances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection|Alarm[]
     */
    public function getAlarms(): Collection
    {
        return $this->alarms;
    }

    public function addAlarm(Alarm $alarm): self
    {
        if (!$this->alarms->contains($alarm)) {
            $this->alarms[] = $alarm;
            $alarm->setDevice($this);
        }

        return $this;
    }

    public function removeAlarm(Alarm $alarm): self
    {
        if ($this->alarms->contains($alarm)) {
            $this->alarms->removeElement($alarm);
            // set the owning side to null (unless already changed)
            if ($alarm->getDevice() === $this) {
                $alarm->setDevice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Maintenance[]
     */
    public function getMaintenances(): Collection
    {
        return $this->maintenances;
    }

    public function addMaintenance(Maintenance $maintenance): self
    {
        if (!$this->maintenances->contains($maintenance)) {
            $this->maintenances[] = $maintenance;
            $maintenance->setDevice($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->maintenances->contains($maintenance)) {
            $this->maintenances->removeElement($maintenance);
            // set the owning side to null (unless already changed)
            if ($maintenance->getDevice() === $this) {
                $maintenance->setDevice(null);
            }
        }

        return $this;
    }

    public function getNotice(): ?Notice
    {
        return $this->notice;
    }

    public function setNotice(Notice $notice): self
    {
        $this->notice = $notice;

        // set the owning side of the relation if necessary
        if ($notice->getDevice() !== $this) {
            $notice->setDevice($this);
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }
}
