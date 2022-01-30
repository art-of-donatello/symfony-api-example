<?php

namespace App\Security;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\Key;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Firebase\JWT\JWT;
use App\Entity\User;



class JwtAuthenticator extends AbstractGuardAuthenticator
{
    private $em;
    private $params;

    public function __construct(EntityManagerInterface $em, ContainerBagInterface $params)
    {
        $this->em = $em;
        $this->params = $params;
    }

    public function start( Request $request , AuthenticationException $authException = null )
    {
        // TODO: Implement start() method.
        $data = [
            'message' => 'Authentication Required'
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supports( Request $request )
    {
        // TODO: Implement supports() method.
        return $request->headers->has('Authorization');
    }

    public function getCredentials( Request $request )
    {
        // TODO: Implement getCredentials() method.
        return $request->headers->get('Authorization');
    }

    public function getUser( $credentials , UserProviderInterface $userProvider )
    {
        // TODO: Implement getUser() method.
        try {

            $credentials = str_replace('Bearer ', '', $credentials);

            $jwt = (array) JWT::decode(
                $credentials,
                new Key($this->params->get('jwt_secret'), 'HS256')

            );

           $user= $this->em->getRepository(User::class)
                ->findOneBy([
                    'username' => $jwt['user'],
                ]);
            return empty($user)?'':$user;
        }catch (\Exception $exception) {
            throw new AuthenticationException($exception->getMessage());
        }
    }

    public function checkCredentials( $credentials , UserInterface $user )
    {
        // TODO: Implement checkCredentials() method.
        return true;

    }

    public function onAuthenticationFailure( Request $request , AuthenticationException $exception )
    {
        // TODO: Implement onAuthenticationFailure() method.
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess( Request $request , TokenInterface $token , string $providerKey )
    {
        // TODO: Implement onAuthenticationSuccess() method.
        return;
    }

    public function supportsRememberMe()
    {
        // TODO: Implement supportsRememberMe() method.
        return false;
    }
}