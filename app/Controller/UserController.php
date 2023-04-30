<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/api')]
class UserController extends AbstractController
{
    private $formFactory;
    
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data);

        if (!$form->isValid()) {
            return $this->json(['message' => 'Invalid data'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Check if login or email is already taken
        if ($userRepository->findBy(['login' => $user->getLogin()])) {
            return $this->json(['message' => 'Login already taken'], Response::HTTP_BAD_REQUEST);
        }

        if ($userRepository->findBy(['email' => $user->getEmail()])) {
            return $this->json(['message' => 'Email already taken'], Response::HTTP_BAD_REQUEST);
        }

        $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
        $user->setRoles(['ROLE_USER']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => 'User registered!'], Response::HTTP_CREATED);
    }


    #[Route('/register/admin', name: 'user_register', methods: ['POST'])]
    public function registerAdmin(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data);

        if (!$form->isValid()) {
            return $this->json(['message' => 'Invalid data'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Check if login or email is already taken
        if ($userRepository->findBy(['login' => $user->getLogin()])) {
            return $this->json(['message' => 'Login already taken'], Response::HTTP_BAD_REQUEST);
        }

        if ($userRepository->findBy(['email' => $user->getEmail()])) {
            return $this->json(['message' => 'Email already taken'], Response::HTTP_BAD_REQUEST);
        }

        $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
        $user->setRoles(['ROLE_ADMIN']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => 'User registered!'], Response::HTTP_CREATED);
    }

    #[Route('/login', name: 'user_login', methods: ['POST'])]
    public function login(Request $request, AuthenticationUtils $authenticationUtils, JWTTokenManagerInterface $jwtManager, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $data['email']]);
    
        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_UNAUTHORIZED);
        }
    
        $isValid = $passwordEncoder->isPasswordValid($user, $data['password']);
        if (!$isValid) {
            return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }
    
        $token = $jwtManager->create($user);
    
        return $this->json([
            'message' => 'User logged in successfully!',
            'token' => $token,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(LogoutUrlGenerator $logoutUrlGenerator): Response
    {
    return $this->redirect($logoutUrlGenerator->getLogoutUrl());
    }
    
    #[Route('/user', name: 'user_get_current', methods: ['GET'])]
    #[IsGranted("ROLE_USER")]
    public function getCurrentUser(): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['message' => 'Not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'login' => $user->getLogin(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'roles' => $user->getRoles(),
        ]);
    }

    #[Route('/user', name: 'user_update', methods: ['PUT'])] 
    #[IsGranted("ROLE_USER")]
    public function updateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->getUser();
        if (!$user) {
            return $this->json(['message' => 'Not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $form = $this->createForm(UserType::class, $user, ['method' => 'PUT']);
        $form->submit($data, false);

        if (!$form->isValid()) {
            return $this->json(['message' => 'Invalid data'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (isset($data['password'])) {
            $user->setPassword($passwordEncoder->encodePassword($user, $data['password']));
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json(['message' => 'User updated!']);
    }
}
