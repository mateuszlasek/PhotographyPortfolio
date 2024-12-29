<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(PhotoRepository $photoRepository, CacheInterface $cache): Response
    {
        $cacheKey = 'main_index_photos';

        $photos = $cache->get($cacheKey, function (ItemInterface $item) use ($photoRepository) {
            $item->expiresAfter(3600);

            return $photoRepository->findAll();
        });

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'photos' => $photos
        ]);
    }

    #[Route('/portfolio', name: 'portfolio')]
    public function portfolio(PhotoRepository $photoRepository, CacheInterface $cache): Response
    {
        $cacheKey = 'portfolio_index_photos';

        $photos = $cache->get($cacheKey, function (ItemInterface $item) use ($photoRepository) {
            $item->expiresAfter(3600);

            return $photoRepository->findAll();
        });

        return $this->render('main/portfolio.html.twig', [
            'controller_name' => 'MainController',
            'photos' => $photos
        ]);
    }

    #[Route('/o-mnie', name: 'about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/kontakt', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('mateusz.lasek@student.up.krakow.pl')
                ->subject('Wiadomość kontaktowa')
                ->text('Imię: ' . $data['name'] . "\nWiadomość: " . $data['message']);

            $mailer->send($email);

            $this->addFlash('success', 'Wiadomość została wysłana!');

            return $this->redirectToRoute('contact');
        }

        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
        ]);
    }
}
