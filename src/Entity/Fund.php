<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\FundRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;

#[ORM\Entity(repositoryClass: FundRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]            // api/funds.json?name=string
#[ApiFilter(SearchFilter::class, properties: ['manager.id' => 'partial'])]      // TODO Fix this search
#[ApiFilter(DateFilter::class, properties: ['startYear'])]                      // api/funds.json?startYear[after]=2025-01-01
#[ApiFilter(OrderFilter::class, properties: ['name' => 'ASC'])]                 // api/funds.json?order[name]=desc
class Fund
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read', 'write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['read', 'write'])]
    private ?\DateTimeInterface $startYear = null;

    #[ORM\ManyToOne(inversedBy: 'funds')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read', 'write'])]
    private ?Manager $manager = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $duplicateFund = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStartYear(): ?\DateTimeInterface
    {
        return $this->startYear;
    }

    public function setStartYear(\DateTimeInterface $startYear): static
    {
        $this->startYear = $startYear;

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): static
    {
        $this->manager = $manager;

        return $this;
    }

    public function getDuplicateFund(): ?self
    {
        return $this->duplicateFund;
    }

    public function setDuplicateFund(?self $duplicateFund): static
    {
        $this->duplicateFund = $duplicateFund;

        return $this;
    }
}
