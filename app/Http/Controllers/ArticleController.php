<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Router\Exception\ResourceNotFoundException;
use App\Domain\Article\ArticleService;

final class ArticleController extends AbstractController
{

    public function __construct(private readonly ArticleService $articleService)
    {
    }

    public function list(): void
    {
        $articles = $this->articleService->list();

        echo json_encode($articles);
    }

    public function create(): void
    {
        $article = $this->articleService->create($_POST);

        echo json_encode($article);
    }

    public function get(string $id): void
    {
        $article = $this->articleService->getById((int)$id);

        if (!$article) {
            throw new ResourceNotFoundException();
        }

        echo json_encode($article);
    }
}