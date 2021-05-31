<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/defaults/", requirements={"page"="\d+"}, name="app_index")
     * @Route("/",name="app_index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }
    /**
     * @Route("/defaults/{page}",  methods={"GET"}, requirements={"page"="\d+"}, name="app_show")
     */
    public function show(int $page): Response
    {
        return $this->render('default/index.html.twig', [
            'website' => 'Wild Séries',
            'page' => $page
        ]);
    }
}