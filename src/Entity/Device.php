<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
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
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="text")
     */
    private $illustration;

    /**
     * @ORM\OneToMany(targetEntity=Alarm::class, mappedBy="device")
     */
    private $alarms;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="device")
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
}
