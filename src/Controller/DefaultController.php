<?php

namespace App\Controller;

use App\Domain\Enum\VendorType;
use App\Domain\VendorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private VendorRepository $vendorRepository,
    ) {
    }

    #[Route('/', name: 'default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    #[Route('/vendorTypes', name: 'types')]
    public function vendorTypes(): Response
    {
        return $this->json(VendorType::cases());
    }

    #[Route('/vendors/{vendorType}', name: 'vendors')]
    public function vendors(string $vendorType): Response
    {
        return $this->json(
            $this->vendorRepository->findByVendorType(VendorType::from($vendorType))
        );
    }
}
