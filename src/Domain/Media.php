<?php declare(strict_types=1);

namespace Stepanets\SeaBattle\Domain;

interface Media
{
    public function drawField(array $field, string $title, int $cols): void;
}