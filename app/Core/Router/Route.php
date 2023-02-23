<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Http\Enum\HttpMethodEnum;

final class Route
{
    private array $vars = [];

    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly array $parameters,
        private readonly HttpMethodEnum $method = HttpMethodEnum::GET
    ) {
    }

    public function match(string $path, string $method): bool
    {
        $regex = $this->getPath();
        foreach ($this->getVarsNames() as $variable) {
            $varName = trim($variable, '{\}');
            $regex = str_replace($variable, '(?P<' . $varName . '>[^/]++)', $regex);
        }

        // Check http method and filter params
        if ($method === $this->getMethod() && preg_match(
                '#^' . $regex . '$#sD',
                self::trimPath($path),
                $matches
            )) {
            $values = array_filter($matches, static function ($key) {
                return is_string($key);
            }, ARRAY_FILTER_USE_KEY);

            foreach ($values as $key => $value) {
                $this->vars[$key] = $value;
            }

            return true;
        }

        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getMethod(): string
    {
        return $this->method->value;
    }

    public function getVars(): array
    {
        return $this->vars;
    }

    private function getVarsNames(): array
    {
        preg_match_all('/{[^}]*}/', $this->path, $matches);

        return reset($matches) ?? [];
    }

    private static function trimPath(string $path): string
    {
        return '/' . rtrim(ltrim(trim($path), '/'), '/');
    }
}