<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SubscribeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/subscribe', name: 'subscribe')]
    public function subscribe(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder)
    {
        $username = new User;

        $form = $this->createForm(SubscribeType::class, $username);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->hashPassword($username, $username->getPassword());

            $username->setPassword($hash);
            $username->setRoles(["ROLE_USER"]);
            $manager->persist($username);
            $manager->flush();
            $this->addFlash("success","Vous avez bien été inscrit");

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/subscribe.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
