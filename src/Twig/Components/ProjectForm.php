<?php

namespace App\Twig\Components;

use App\Entity\Project;
use App\Form\Type\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;


#[AsLiveComponent]
class ProjectForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public ?Project $initialProject = null;

    protected function instantiateForm(): FormInterface
    {
        $this->initialProject = new Project();

        return $this->createForm(ProjectType::class, $this->initialProject);
    }

    #[LiveAction]
    public function save(EntityManagerInterface $manager): Response
    {
        $this->validate();
        $this->submitForm();

        $project = $this->getForm()->getData();
        $manager->persist($project);

        $user = $this->getUser();
        $user->addProject($project);
        $user->setSelectedProject($project);

        $manager->flush();

        return $this->redirectToRoute('project_show', [
            'keyCode' => $project->getKeyCode()
        ]);
    }
}