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

    public function create(array $data): ?int
    {
        try {
            $article = (new Article())
                ->setTitle($data['title'])
                ->setText($data['text'])
                ->setImageUrl($data['image_url'])
                ->setAuthorId($data['author_id']);

            return $this->articleRepository->create($article);
        } catch (Throwable) {
            return null;
        }
    }

    public function list(int $page = 1): ?array
    {
        [$limit, $offset] = $this->getLimitAndOffset($page);

        return $this->articleRepository->list($limit, $offset);
    }

    public function getPagesCount(array $filter = []): int
    {
        return $this->getTotalPagesCount($this->articleRepository->getTotalCount($filter));
    }

    public function getById(int $id): ?Article
    {
        return $this->articleRepository->getById($id);
    }
}