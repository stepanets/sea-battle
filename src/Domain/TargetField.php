<?php

declare(strict_types=1);

namespace Stepanets\SeaBattle\Domain;

interface TargetField
{
    public function corner(): Coordinate;

    public function handleShoot(Coordinate $pair): int;

    public function allDestroyed(): bool;
}