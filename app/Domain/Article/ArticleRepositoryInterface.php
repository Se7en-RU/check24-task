<?php

namespace App\Domain\Article;

interface ArticleRepositoryInterface
{
    public function create(Article $article): ?int;

    public function list(int $limit, int $offset, array $filter = []): ?array;

    public function getById(int $id): ?Article;

    public function getTotalCount(array $filter = []): int;
}