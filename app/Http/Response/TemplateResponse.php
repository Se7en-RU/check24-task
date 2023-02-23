<?php

declare(strict_types=1);


namespace App\Http\Response;

final class TemplateResponse
{
    public function __construct(public string $templateName, public array $params = [])
    {
    }
}