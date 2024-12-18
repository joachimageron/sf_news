<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{name}', name: 'app_category')]
    public function item(Category $category): Response
    {
        $articles = $category->getArticles();

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}
