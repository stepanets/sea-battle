<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

interface TargetField
{
    public function handleShoot(Coordinate $coordinate): ShootResult;

    public function placeShip(Ship $ship): void;
}