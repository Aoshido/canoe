<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ManagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
#[ApiResource(
    shortName: 'Manager',
    description: 'Funds are created and managed by an investment management company',
    normalizationContext: [
        'groups' => ['manager:read'],
    ],
    denormalizationContext: [
        'groups' => ['manager:read'],
    ]
)]

class Manager
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['manager:read'])]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: Fund::class)]
    #[Groups(['manager:read'])]
    private Collection $funds;

    public function __construct()
    {
        $this->funds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Fund>
     */
    public function getFunds(): Collection
    {
        return $this->funds;
    }

    public function addFund(Fund $fund): static
    {
        if (!$this->funds->contains($fund)) {
            $this->funds->add($fund);
            $fund->setManager($this);
        }

        return $this;
    }

    public function removeFund(Fund $fund): static
    {
        if ($this->funds->removeElement($fund)) {
            // set the owning side to null (unless already changed)
            if ($fund->getManager() === $this) {
                $fund->setManager(null);
            }
        }

        return $this;
    }
}
