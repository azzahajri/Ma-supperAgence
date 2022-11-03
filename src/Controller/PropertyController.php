<?php

namespace App\Controller;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class PropertyController extends AbstractController
{
    /**
     * @Var PropertyRepository
     * @ORM\Column(type="string")
     */
    private $repository;

    /**
     * @var  EntityManagerInterface $em
     */
    private $em;
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        $properties= $this->repository->findAllVisible();
        return $this->render('property/index.html.twig', [
            'current_menu' =>'properties',
            'properties' =>'properties'
            ]);
    }

      /**
       * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
       */
   public function show(Property $property, string $slug): Response
   {
       if($property->getSlug() !== $slug)
       {
          return $this->redirectToRoute('property.show', [
               'id' => $property->getId(),
               'slug' => $property->getSlug()
           ],301);
       }
       return $this->render('property/show.html.twig', [
           'property' => $property,
               'current_menu' =>'properties']
       );
   }
}
