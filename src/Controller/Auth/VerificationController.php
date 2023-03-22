<?php

namespace App\Controller\Auth;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class VerificationController extends AbstractController
{
    #[Route('/api/auth/verified/{givenToken}', name: 'api_verified')]
    public function index(string $givenToken, EntityManagerInterface $em, Security $security, JWTTokenManagerInterface $jwtManager): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['verificationToken' => $givenToken]);

        if (null === $user) {
            return $this->json([
                'message' => 'test',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->setEmailVerifiedAt(new \DateTime());
        $user->setVerificationToken(null);

        $security->login($user);

        $em->flush();

        $token = $jwtManager->create($user);

        return $this->json([
            'token' => $token,
        ]);
    }

    #[Route('/api/auth/logout', name: 'api_logout')]
    public function logout(): Response
    {
        return $this->json([
            'message' => 'logout successful',
        ]);
    }
}
