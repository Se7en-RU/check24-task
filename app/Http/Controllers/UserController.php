<?php

declare(strict_types=1);


namespace App\Http\Controllers;


use App\Core\Router\Exception\ResourceNotFoundException;
use App\Domain\User\UserService;
use App\Http\Exception\ControllerException;
use App\Http\Response\TemplateResponse;

class UserController extends AbstractController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /** @throws ControllerException */
    public function loginPage(): TemplateResponse
    {
        if (isset($_SESSION['user'])) {
            throw new ControllerException('User already logged in');
        }

        return new TemplateResponse('users/login.html.twig');
    }

    public function loginForm(): void
    {
        $data = $_POST;

        if (empty($data['login'])) {
            $_SESSION['errors'][] = 'Login not provided';

            header("Location: /login");
            die();
        }

        if (empty($data['password'])) {
            $_SESSION['errors'][] = 'Password not provided';

            header("Location: /login");
            die();
        }

        if ($this->userService->login($data['login'], $data['password']) === false) {
            $_SESSION['errors'][] = 'Incorrect credentials';

            header("Location: /login");
            die();
        }

        header("Location: /");
    }

//    public function registerPage(): TemplateResponse
//    {
//        if (isset($_SESSION['user'])) {
//            throw new ControllerException('User already logged in');
//        }
//
//        return new TemplateResponse('users/register.html.twig');
//    }

//    public function registerForm(): TemplateResponse
//    {
//        $this->userService->register(['login' => 'test', 'password' => 'test']);
////        return new TemplateResponse(
////            'articles/list.html.twig');
//    }

    /**
     * @throws ResourceNotFoundException
     */
    public function logout(): void
    {
        if (!isset($_SESSION['user'])) {
            throw new ResourceNotFoundException('User is not logged in');
        }

        $this->userService->logout();

        header("Location: /");
    }
}