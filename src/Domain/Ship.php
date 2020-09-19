<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

interface Ship
{
    /**
     * @return Coordinate[]
     */
    public function coords(): array;

    public function handleShoot(Coordinate $coordinate): ShootResult;
}