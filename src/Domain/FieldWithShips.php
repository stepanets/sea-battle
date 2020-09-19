<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

final class FieldWithShips implements TargetField
{
    private Matrix $matrix;

    /**
     * FieldWithShips constructor.
     * @param Matrix $matrix
     */
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function handleShoot(Coordinate $c): ShootResult
    {
        if ($this->matrix->isEmpty($c)) {
            return new MissResult($c);
        }
        $this->matrix->markDamage($c);

        return new DamageResult($c);
    }

    public function placeShip(Ship $ship): void
    {
        foreach ($ship->coords() as $coordinate) {
            $this->matrix->markShip($coordinate);
        }
    }
}