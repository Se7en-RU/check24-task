<?php

namespace App\Domain\Support;

trait PaginationTrait
{
    /** @return array<int, int> */
    private function getLimitAndOffset(int $page, ?int $itemsPerPage = 10): array
    {
        if ($page <= 0) {
            $page = 1;
        }

        $itemsPerPage = !empty($_ENV['ITEMS_PER_PAGE']) ? (int)$_ENV['ITEMS_PER_PAGE'] : $itemsPerPage;

        if ($itemsPerPage < 1) {
            $itemsPerPage = 1;
        }

        return [
            $itemsPerPage,
            ($page - 1) * $itemsPerPage,
        ];
    }
}