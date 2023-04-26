<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CastingOfferRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


#[Route('/api/users', name: 'api_user_')]
class UserController extends AbstractController
{
    #[Route('/profile', name: 'profile', methods: ['GET'], priority: 2)]
    public function profile(#[CurrentUser] ?User $profile): Response
    {

        if (!$profile) {
            return $this->json(['message' => 'User not found'], 404);
        }

        return $this->json(['message' => 'ok', 'profile' => $profile], 200);
    }

    #[Route('/postuler/{id}', name: 'postuler', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function postuler(CastingOfferRepository $repo, $id, #[CurrentUser] ?User $user, EntityManagerInterface $em): Response
    {
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $user->addOffer($repo->find($id));
        $em->flush();

        return $this->json(['message' => 'ok', 'profile' => $user], 200);
    }

    #[Route('/depostuler/{id}', name: 'depostuler', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function depostuler(CastingOfferRepository $repo, $id, #[CurrentUser] ?User $user, EntityManagerInterface $em): Response
    {
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $user->removeOffer($repo->find($id));
        $em->flush();

        return $this->json(['message' => 'ok', 'profile' => $user], 200);
    }

    #[Route('/get-id', name: 'get-id', methods: ['GET'], priority: 2)]
    public function getId(#[CurrentUser] ?User $user): Response
    {
        if (!$user) {
            return $this->json(['message' => 'User not found'], 500);
        }

        return $this->json(['message' => 'ok', 'id' => $user->getId()], 200);
    }
}
