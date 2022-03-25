<?php

namespace App\Entity;

use App\Repository\RegisterationEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RegisterationEntityRepository::class)]
class RegistrationEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: StudentEntity::class, inversedBy: 'registrationEntities')]
    private $student;

    #[ORM\ManyToOne(targetEntity: CourseEntity::class, inversedBy: 'registrationEntities')]
    private $course;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStudent(): ?StudentEntity
    {
        return $this->student;
    }

    public function setStudent(?StudentEntity $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getCourse(): ?CourseEntity
    {
        return $this->course;
    }

    public function setCourse(?CourseEntity $course): self
    {
        $this->course = $course;

        return $this;
    }
}
