<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface AttackResult
{
    public function isOver(): bool;

    public function print();
}