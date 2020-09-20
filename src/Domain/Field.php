<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Matrix;

final class Field implements TargetField
{
    public const SHOOT_MISS = 0;
    public const SHOOT_DAMAGE = 1;
    public const SHOOT_KILL = 2;

    private const CELL_SHIP = 1;
    private const CELL_DAMAGED_SHIP = 2;

    /**
     * @var Matrix
     */
    private Matrix $matrix;

    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function corner(): Coordinate
    {
        return new Coordinate($this->matrix->rows() - 1, $this->matrix->cols() - 1);
    }

    public function placeShip(Coordinate ...$coords): void
    {
        foreach ($coords as $pair) {
            $this->matrix->markCell($pair, self::CELL_SHIP);
        }
    }

    public function handleShoot(Coordinate $pair): int
    {
        if ($this->matrix->code($pair) === self::CELL_SHIP) {
            $this->matrix->markCell($pair, self::CELL_DAMAGED_SHIP);
            return $this->hasNeighborOfType($pair, self::CELL_SHIP) ? self::SHOOT_DAMAGE : self::SHOOT_KILL;
        }

        return self::SHOOT_MISS;
    }

    public function allDestroyed(): bool
    {
        return !$this->matrix->has(self::CELL_SHIP);
    }

    public function draw(Media $media, string $title): void
    {
        $media->drawField($this->matrix->asArray(), $title, $this->matrix->cols());
    }

    private function hasNeighborOfType(Coordinate $pair, int $type): bool
    {
        foreach ($this->matrix->neighbors($pair) as $neighbor) {
            if ($this->matrix->code($neighbor) === $type) {
                return true;
            }
        }

        return false;
    }
}