<?php

namespace App\Twig\Components;

use App\Service\IssueService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class ProjectBoard
{
    use DefaultActionTrait;

    /** @var \App\Entity\Issue[] */
    #[LiveProp(writable: true)]
    public array $readyIssues = [];

    /** @var \App\Entity\Issue[] */
    #[LiveProp(writable: true)]
    public array $inProgressIssues = [];

    /** @var \App\Entity\Issue[] */
    #[LiveProp(writable: true)]
    public array $resolvedIssues = [];

    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly IssueService $service,
    )
    {
    }

    public function mount(): void
    {
        $this->getIssues();
    }

    #[LiveAction]
    public function getIssues(): void
    {
        $this->readyIssues = $this->service->getReadyIssues();
        $this->inProgressIssues = $this->service->getInProgressIssues();
        $this->resolvedIssues = $this->service->getResolvedIssues();
    }
}
