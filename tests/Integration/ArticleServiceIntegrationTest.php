<?php

declare(strict_types=1);

namespace Integration;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Article\ArticleService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;


class ArticleServiceIntegrationTest extends TestCase
{
    /** @test
     * @group integration
     * @throws Exception
     */
    public function getByIdSuccess(): void
    {
        $id = 123;
        $title = 'test title';

        $article = (new Article())
            ->setId($id)
            ->setTitle($title)
            ->setText('test text');

        $repositoryMock = $this->createMock(ArticleRepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('getById')
            ->willReturn($article);

        $articleService = new ArticleService($repositoryMock);
        $result = $articleService->getById($id);

        $this->assertEquals($article->getId(), $result->getId());
    }
}