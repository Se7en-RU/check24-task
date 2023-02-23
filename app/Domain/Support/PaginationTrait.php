<?php

namespace App\Domain\Support;

trait PaginationTrait
{
    /** @return array<int, int> */
    private function getLimitAndOffset(int $page, ?int $itemsPerPage = 3): array
    {
        if ($page <= 0) {
            $page = 1;
        }

        $itemsPerPage = $this->getItemsPerPage($itemsPerPage);

        if ($itemsPerPage < 1) {
            $itemsPerPage = 1;
        }

        return [
            $itemsPerPage,
            ($page - 1) * $itemsPerPage,
        ];
    }

    private function getTotalPagesCount(int $totalItemsCount, ?int $itemsPerPage = 3): int
    {
        $itemsPerPage = $this->getItemsPerPage($itemsPerPage);

        return (int)ceil($totalItemsCount / $itemsPerPage);
    }

    private function getItemsPerPage(?int $itemsPerPage = 3): int
    {
        return !empty($_ENV['ITEMS_PER_PAGE']) ? (int)$_ENV['ITEMS_PER_PAGE'] : $itemsPerPage;
    }
}