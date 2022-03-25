<?php

namespace App\Entity;

use App\Repository\CourseEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseEntityRepository::class)]
class CourseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $capacity;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: RegistrationEntity::class)]
    private $registrationEntities;

    public function __construct()
    {
        $this->registrationEntities = new ArrayCollection();
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

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, RegistrationEntity>
     */
    public function getRegistrationEntities(): Collection
    {
        return $this->registrationEntities;
    }

    public function addRegistrationEntity(RegistrationEntity $registrationEntity): self
    {
        if (!$this->registrationEntities->contains($registrationEntity)) {
            $this->registrationEntities[] = $registrationEntity;
            $registrationEntity->setCourse($this);
        }

        return $this;
    }

    public function removeRegistrationEntity(RegistrationEntity $registrationEntity): self
    {
        if ($this->registrationEntities->removeElement($registrationEntity)) {
            // set the owning side to null (unless already changed)
            if ($registrationEntity->getCourse() === $this) {
                $registrationEntity->setCourse(null);
            }
        }

        return $this;
    }
}
