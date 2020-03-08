<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationsRepository")
 */
class Applications
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ApplicationName;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ApplicationVersion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ApplicationDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplicationName(): ?string
    {
        return $this->ApplicationName;
    }

    public function setApplicationName(string $ApplicationName): self
    {
        $this->ApplicationName = $ApplicationName;

        return $this;
    }

    public function getApplicationVersion(): ?string
    {
        return $this->ApplicationVersion;
    }

    public function setApplicationVersion(string $ApplicationVersion): self
    {
        $this->ApplicationVersion = $ApplicationVersion;

        return $this;
    }

    public function getApplicationDescription(): ?string
    {
        return $this->ApplicationDescription;
    }

    public function setApplicationDescription(?string $ApplicationDescription): self
    {
        $this->ApplicationDescription = $ApplicationDescription;

        return $this;
    }
}
