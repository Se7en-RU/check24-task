<?php

declare(strict_types=1);

namespace Unit;

use App\Domain\Support\PaginationTrait;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;


class PaginationTraitUnitTest extends TestCase
{
    use PaginationTrait;

    /** @test
     * @group unit
     */
    public function getLimitAndOffsetSuccess(): void
    {
        $this->assertEquals([25, 0], $this->getLimitAndOffset(1, 25));
        $this->assertEquals([20, 20], $this->getLimitAndOffset(2, 20));
        $this->assertEquals([1, 9], $this->getLimitAndOffset(10, -1));
        $this->assertEquals([30, 0], $this->getLimitAndOffset(-1, 30));
    }
}