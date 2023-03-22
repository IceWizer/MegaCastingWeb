<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\API\ExceptionConverter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/auth', name: 'auth_')]
class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine, UserRepository $userRepository, SerializerInterface $serializer, MailerInterface $mailer): Response
    {
        try {
            $entityManager = $doctrine->getManager();

            $data = json_decode($request->getContent(), true);

            if (empty($data['username'])) {
                return new Response('Username is required', Response::HTTP_BAD_REQUEST);
            } elseif (empty($data['email'])) {
                return new Response('Email is required', Response::HTTP_BAD_REQUEST);
            } elseif (empty($data['password'])) {
                return new Response('Password is required', Response::HTTP_BAD_REQUEST);
            } elseif (empty($data['password_confirm'])) {
                return new Response('Password confirmation is required', Response::HTTP_BAD_REQUEST);
            } elseif (empty($data['accept_terms'])) {
                return new Response('You must accept the terms', Response::HTTP_BAD_REQUEST);
            }

            if ($data['password'] != $data['password_confirm']) {
                return new Response('Passwords do not match', Response::HTTP_BAD_REQUEST);
            }

            if ($userRepository->findOneBy(['username' => $data['username']])) {
                return new Response('Username already exists', Response::HTTP_BAD_REQUEST);
            } elseif ($userRepository->findOneBy(['email' => $data['email']])) {
                return new Response('Email already exists', Response::HTTP_BAD_REQUEST);
            }

            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setRoles($data['username'] == 'IceWize' ? ['ROLE_USER', 'ROLE_ADMIN']: ['ROLE_USER']);
            $plaintextPassword = $data['password'];

            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user->setTermAccepted($data['accept_terms']);
            $randomToken = bin2hex(random_bytes(30));
            while ($doctrine->getRepository(User::class)->findOneBy(['verificationToken' => $randomToken])) {
                $randomToken = bin2hex(random_bytes(30));
            }
            $user->setVerificationToken($randomToken);

            // Create a new email
            $email = (new TemplatedEmail())
                ->from(Address::create('Megacasting <megacasting@icewize.fr>'))
                ->to($user->getEmail())
                ->subject('Confirmation de votre compte')
                ->htmlTemplate('emails/registration.html.twig')
                ->context([
                    'user' => $user,
                    'signedUrl' => $request->getSchemeAndHttpHost() . '/verify/' . $user->getVerificationToken(),
                ]);

            // Send the email
            try {
                $mailer->send($email);
            } catch (\Exception $e) {
                return new Response('Error: ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString() . PHP_EOL . $e->getFile() . 'line' . $e->getLine() , Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response($serializer->serialize(['message' => 'User created successfully', 'payload' => $user], 'json'), Response::HTTP_CREATED);
        } catch (ExceptionConverter $e) {
            return new Response('Error: ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString() . PHP_EOL . $e->getFile() . 'line' . $e->getLine() , Response::HTTP_BAD_REQUEST);
        }
    }
}
