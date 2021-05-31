<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Doctrine\ORM\Query\AST\Functions\IdentityFunction;
use Symfony\Component\HttpFoundation\Response;
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