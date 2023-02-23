<?php

declare(strict_types=1);


namespace App\Infrastructure\Repository;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;
use App\Infrastructure\Database\DatabaseInterface;

class ArticleDatabaseRepository implements ArticleRepositoryInterface
{
    public function __construct(private readonly DatabaseInterface $database)
    {
    }

    public function create(Article $article): void
    {
        $this->database->query(
            'INSERT INTO articles (title, text, author_id) VALUES (:title, :text, :author_id)',
            [
                ':title' => $article->getTitle(),
                ':text' => $article->getText(),
                ':author_id' => $article->getAuthorId(),
            ]
        );
    }

    /** @return array<Article>|null */
    public function list(int $limit, int $offset): ?array
    {
        $res = $this->database->query(
            "SELECT * FROM articles LIMIT $limit OFFSET $offset",
        );

        return !empty($res) ? $res : null;
    }

    public function getById(int $id): ?Article
    {
        $res = $this->database->query(
            'SELECT * FROM articles WHERE id=:id',
            [':id' => $id],
            Article::class
        );

        return !empty($res) ? $res[0] : null;
    }
}