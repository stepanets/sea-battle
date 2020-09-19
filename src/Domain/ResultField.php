<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

interface ResultField
{
    public function markMissed(Coordinate $coordinate): void;

    public function markDamaged(Coordinate $coordinate): void;

    public function markKilled(Coordinate $coordinate): void;
}