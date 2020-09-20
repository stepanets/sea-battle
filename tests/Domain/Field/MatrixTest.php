<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Tests\Domain\Field;


use PHPUnit\Framework\TestCase;
use Stepanets\SeaBattle\Domain\Coordinate;
use Stepanets\SeaBattle\Domain\Field\Matrix;

final class MatrixTest extends TestCase
{
    public function testMarkCell(): void
    {
        $m = Matrix::zero(3, 3);
        $m->markCell(new Coordinate(1, 1), 9);
        self::assertEquals(
            [
                [0, 0, 0,],
                [0, 9, 0,],
                [0, 0, 0,],
            ],
            $m->asArray()
        );
    }

    /**
     * @dataProvider dataCode
     * @param int $code
     * @param Coordinate $pair
     */
    public function testCode(int $code, Coordinate $pair): void
    {
        $m = new Matrix(
            [
                [1, 2, 3,],
                [4, 5, 6,],
                [7, 8, 9,],
            ]
        );

        self::assertEquals(
            $code,
            $m->code($pair)
        );
    }

    public function dataCode(): array
    {
        return [
            [1, new Coordinate(0, 0)],
            [2, new Coordinate(0, 1)],
            [3, new Coordinate(0, 2)],
            [4, new Coordinate(1, 0)],
            [5, new Coordinate(1, 1)],
            [6, new Coordinate(1, 2)],
            [7, new Coordinate(2, 0)],
            [8, new Coordinate(2, 1)],
            [9, new Coordinate(2, 2)],
        ];
    }

    public function testNeighbors(): void
    {
        $m = Matrix::zero(3, 3);
        $n1 = $m->neighbors(new Coordinate(0, 0));
        self::assertCount(3, $n1);

        $n2 = $m->neighbors(new Coordinate(1, 0));
        self::assertCount(5, $n2);

        $n3 = $m->neighbors(new Coordinate(1, 1));
        self::assertCount(8, $n3);
    }
}