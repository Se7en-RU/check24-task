<?php

namespace App\Domain\Article;


interface ArticleRepositoryInterface
{
    public function create(Article $article): void;

    public function list(int $limit, int $offset): ?array;

    public function getById(int $id): ?Article;
}