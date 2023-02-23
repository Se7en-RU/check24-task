<?php

declare(strict_types=1);

namespace App\Domain\Article;

use App\Domain\Support\PaginationTrait;
use Throwable;

class ArticleService
{
    use PaginationTrait;

    public function __construct(private readonly ArticleRepositoryInterface $articleRepository)
    {
    }

    public function create(array $data): bool
    {
        try {
            $article = (new Article())
                ->setTitle($data['title'])
                ->setText($data['text'])
                ->setAuthorId((int)$data['author_id']);

            $this->articleRepository->create($article);
        } catch (Throwable) {
            return false;
        }

        return true;
    }

    public function list(int $page = 1): ?array
    {
        [$limit, $offset] = $this->getLimitAndOffset($page);

        // TODO check for null
        $articles = $this->articleRepository->list($limit, $offset);

        return $articles;
    }

    public function getById(int $id): ?Article
    {
        $article = $this->articleRepository->getById($id);

        // TODO
//        if (!$article) {
//            throw new Exception('Article not found');
//        }

        return $article;
    }
}