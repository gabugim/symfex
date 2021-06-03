<?php


namespace App\Controller;

use App\Form\CategoryType;
use App\Entity\Category;
use App\Entity\Program;
use Doctrine\ORM\Query\AST\Functions\IdentityFunction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */

class CategoryController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * Show all rows from categorie’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * The controller for the category add form
     *
     * @Route("/new", name="new")
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $category = new Category();
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($category);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }
        // Render the form
        return $this->render('category/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    // L'action show() se trouvera plus bas


    /**
     * Getting a category by id
     *
     * @Route("/{categoryName}", name="show")
     * @return Response
     */
    public function show(string $categoryName):Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(['name' => $categoryName],
            ['id' => 'DESC']
            );
    if($category){
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findByCategory($category, ['id' => 'DESC']);

    }
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name : '.$categoryName.' found in categorie\'s table.'
            );
        }
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $program
        ]);
    }
}