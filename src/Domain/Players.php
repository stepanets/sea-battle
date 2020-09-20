<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface Players
{
    public function one(): Player;

    public function two(): Player;
}