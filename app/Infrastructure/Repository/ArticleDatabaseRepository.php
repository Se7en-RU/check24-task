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

    public function create(Article $article): ?int
    {
        $this->database->query(
            'INSERT INTO articles (title, text, author_id, image_url) VALUES (:title, :text, :author_id, :image_url)',
            [
                ':title' => $article->getTitle(),
                ':text' => $article->getText(),
                ':image_url' => $article->getImageUrl(),
                ':author_id' => $article->getAuthorId(),
            ]
        );

        return $this->database->query('SELECT LAST_INSERT_ID() as id')[0]?->id ?? null;
    }

    /** @return array<Article>|null */
    public function list(int $limit, int $offset, array $filter = []): ?array
    {
        if (!empty($filter)) {
            [$filterKey, $filterValue] = $filter;

            $res = $this->database->query(
                "SELECT * FROM articles WHERE $filterKey = $filterValue ORDER BY created_at ASC LIMIT $limit OFFSET $offset",
                [":$filterKey" => $filterValue]
            );
        } else {
            $res = $this->database->query(
                "SELECT * FROM articles ORDER BY created_at ASC LIMIT $limit OFFSET $offset",
            );
        }


        return !empty($res) ? $res : null;
    }

    public function getById(int $id): ?Article
    {
        $res = $this->database->query(
            'SELECT * FROM articles WHERE id=:id',
            [':id' => $id]
        );

        if (!empty($res)) {
            $res = $res[0];

            return (new Article())
                ->setId($res->id)
                ->setText($res->text)
                ->setImageUrl($res->image_url)
                ->setTitle($res->title)
                ->setAuthorId($res->author_id)
                ->setCreatedAt($res->created_at)
                ->setUpdatedAt($res->updated_at);
        }

        return null;
    }

    public function getTotalCount(array $filter = []): int
    {
        $res = $this->database->query('SELECT COUNT(*) as count FROM articles');

        return $res[0]?->count ?? 0;
    }
}