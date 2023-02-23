<?php

declare(strict_types=1);


namespace App\Http\Controllers;


class HealthController extends AbstractController
{
    public function __invoke(): void
    {
        echo 'OK';
    }
}