<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MainController extends AbstractController
{
    /**
     * @throws InvalidArgumentException
     */
    #[Route('/main', name: 'app_main')]
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
}
