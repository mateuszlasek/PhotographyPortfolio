<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
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
    public function index(CacheInterface $cache): Response
    {
        $photos = $cache->get('photos_list', function () {
            $imagePath = $this->getParameter('kernel.project_dir') . '/assets/images';

            $finder = new Finder();
            $files = $finder->files()->in($imagePath);

            $photos = [];
            foreach ($files as $file) {
                $photos[] = $file->getFilename();
            }

            return $photos;
        });

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'photos' => $photos
        ]);
    }
}
