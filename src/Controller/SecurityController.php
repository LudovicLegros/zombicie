<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPassType;
use App\Form\SubscribeType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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
    //------------ LOG OUT CONTROLLER----------- 
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    //------------ SUBSCRIBE CONTROLLER----------- 
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

    #[Route(path: '/oubli-pass', name: 'app_forgotten_password')]
    public function oubliPass(Request $request, UserRepository $users, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ResetPassType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $donnees = $form->getData();

            $user = $users->findOneByEmail($donnees['email']);

            if ($user === null){
                $this->addFlash('danger','Cette adresse e-mail est inconnue');
                return $this->redirectToRoute('app_login');
            }

            $token = $tokenGenerator->generateToken();

            $user->setResetToken($token);

            $manager->persist($user);
            $manager->flush();

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            // On génère l'e-mail
            $email = (new Email())

            ->from('contact@ludoviclegros.fr')
            ->to($user->getEmail())
            ->subject('Récupération de mot de passe')
            ->html(
                "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site Nouvelle-Techno.fr. Veuillez cliquer sur le lien suivant : " . $url,
                'text/html'
            );
            // $headers = $message->getHeaders();
            // $headers->addHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply');
            // $message->setHeaders($headers);
        ;

            // On envoie l'e-mail
            $mailer->send($email);

            // On crée le message flash de confirmation
            $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

            // On redirige vers la page de login
            return $this->redirectToRoute('app_login');
        
    }
        // On envoie le formulaire à la vue
        return $this->render('security/forgotten_password.html.twig',[
            'emailForm' => $form->createView()
        ]);
    }

    #[Route(path: 'reset_pass/{token}', name: 'app_reset_password')]
    public function resetPassword(Request $request, UserRepository $users, UserPasswordHasherInterface $passwordEncoder , EntityManagerInterface $entityManager, $token)
    {
        // On cherche un utilisateur avec le token donné
        // dd($users);
        $user = $users->findOneBy(['reset_token' => $token]);
        
        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);

            // On chiffre le mot de passe
            // $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            // dd($request->request->all()['password']);
            $newPassword = $request->request->all()['password'];
            $hash = $passwordEncoder->hashPassword($user, $newPassword);
            // $hash = $encoder->hashPassword($username, $username->getPassword());

            $user->setPassword($hash);

            // On stocke
            $entityManager->persist($user);
            $entityManager->flush();

            // On crée le message flash
            $this->addFlash('message', 'Mot de passe mis à jour');

            // On redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }else {
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}
