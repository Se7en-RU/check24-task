<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Article\ArticleService;
use App\Http\Exception\ControllerException;
use App\Http\Response\TemplateResponse;

final class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleService $articleService)
    {
    }

    /** @throws ControllerException */
    public function listPage(int $page = 1): TemplateResponse
    {
        $articles = $this->articleService->list($page);
        if (empty($articles)) {
            throw new ControllerException('Invalid page');
        }

        return new TemplateResponse(
            'articles/list.html.twig',
            [
                'articles'    => $articles,
                'currentPage' => $page,
                'pagesCount'  => $this->articleService->getPagesCount()
            ]
        );
    }

    /** @throws ControllerException */
    public function detailPage(int $id): TemplateResponse
    {
        $article = $this->articleService->getById($id);
        if (empty($article)) {
            throw new ControllerException('Article not found');
        }

        return new TemplateResponse(
            'articles/detail.html.twig',
            [
                'article' => $article,
            ]
        );
    }

    /** @throws ControllerException */
    public function createPage(): TemplateResponse
    {
        if (!isset($_SESSION['user'])) {
            throw new ControllerException('You need to log in');
        }

        return new TemplateResponse('articles/new.html.twig');
    }

    public function createForm(): void
    {
        $data = $_POST;

        if (empty($data['title'])) {
            $_SESSION['errors'][] = 'Title not provided';

            header("Location: /articles/new");
            die();
        }

        if (empty($data['image_url'])) {
            $_SESSION['errors'][] = 'Picture link not provided';

            header("Location: /articles/new");
            die();
        }

        if (empty($data['text'])) {
            $_SESSION['errors'][] = 'Text not provided';

            header("Location: /articles/new");
            die();
        }

        $data['author_id'] = $_SESSION['user']['id'];
        if ($articleId = $this->articleService->create($data)) {
            header("Location: /articles/$articleId");
            die();
        }

        $_SESSION['errors'][] = 'Error while adding article';
        header("Location: /articles/new");
    }

}