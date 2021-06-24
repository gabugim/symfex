<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/comments", name="comment_")
 */

class CommentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }
//
//    /**
//     * The controller for the comment add form
//     *
//     * @Route("/new", name="new")
//     */
//    public function new(Request $request) : Response
//    {
//        // Create a new Comment Object
//        $comment = new Comment();
//        // Create the associated Form
//        $form = $this->createForm(CommentType::class, $comment);
//        $form->handleRequest($request);
//        // Render the form
//        if ($form->isSubmitted()) {
//            // Deal with the submitted data
//            // Get the Entity Manager
//            $entityManager = $this->getDoctrine()->getManager();
//            $comment->setUser($this->getUser());
//            $comment->setEpisode($this->getEpisode());
//            // Persist Category Object
//            $entityManager->persist($comment);
//            // Flush the persisted object
//            $entityManager->flush();
//            // Finally redirect to categories list
//            return $this->redirectToRoute('comment_index');
//        }
//
//        return $this->render('comment/new.html.twig', [
//            "form" => $form->createView(),
//        ]);
//    }
//
//    // L'action show() se trouvera plus bas
}
