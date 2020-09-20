<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Tests\Domain;


use PHPUnit\Framework\TestCase;
use Stepanets\SeaBattle\Domain\Coordinate;

final class CoordinateTest extends TestCase
{
    /**
     * @dataProvider StringAndInt
     * @param string $pair
     * @param int $row
     * @param int $col
     */
    public function testFromString(string $pair, int $row, int $col): void
    {
        self::assertEquals(
            $row,
            Coordinate::fromString($pair)->row()
        );

        self::assertEquals(
            $col,
            Coordinate::fromString($pair)->col()
        );
    }

    public function StringAndInt(): array
    {
        return [
            ['1A', 0, 0],
            ['5J', 4, 9],
            ['3C', 2, 2],
            ['10A', 9, 0],
        ];
    }
}