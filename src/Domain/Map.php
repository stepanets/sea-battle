<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Matrix;

final class Map
{
    public const CELL_MISSED = 1;
    public const CELL_DAMAGED = 2;

    /**
     * @var Matrix
     */
    private Matrix $matrix;

    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function matrix(): Matrix
    {
        return clone $this->matrix;
    }

    public function markMiss(Coordinate $pair): void
    {
        $this->matrix->markCell($pair, self::CELL_MISSED);
    }

    public function markDamage(Coordinate $pair): void
    {
        $this->matrix->markCell($pair, self::CELL_DAMAGED);
    }

    public function draw(Media $media, string $title): void
    {
        $media->drawField($this->matrix->asArray(), $title, $this->matrix->cols());
    }
}