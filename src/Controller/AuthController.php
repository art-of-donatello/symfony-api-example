<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use Firebase\JWT\JWT;

class AuthController extends AbstractController
{


    /**
     * @Route("/auth/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder,ManagerRegistry $ManagerRegistry)
    {
        $password = $request->get('password');
        $username = $request->get('username');
        $role = $request->get('role');
        $user = new User();
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setUsername($username);
        $user->setRoles(array($role));
        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $this->json([
            'user' => $user->getUserIdentifier()
        ]);
    }

    /**
     * @Route("/auth/login", name="login", methods={"POST"})
     */
    public function login(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $user = $userRepository->findOneBy([
            'username'=>$request->get('username'),
        ]);
        if (!$user || !$encoder->isPasswordValid($user, $request->get('password'))) {
            return $this->json([
                'message' => 'username or password is wrong.',
            ]);
        }
        $payload = [
            "user" => $user->getUserIdentifier(),
            "exp"  => (new \DateTime())->modify("+240 minutes")->getTimestamp(),
        ];

        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
        return $this->json([
            'message' => 'success!',
            'token' => sprintf('Bearer %s', $jwt),
        ]);
    }
}
