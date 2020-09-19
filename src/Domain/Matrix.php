<?php declare(strict_types=1);

namespace Stepanets\SeaBattle\Domain;

use Stepanets\SeaBattle\Domain\Field\Coordinate;

interface Matrix
{
    public function markShip(Coordinate $c): void;

    public function markDamage(Coordinate $c): void;

    public function isEmpty(Coordinate $c): bool;

    public function isShip(Coordinate $c): bool;

    public function isDamaged(Coordinate $c): bool;
}