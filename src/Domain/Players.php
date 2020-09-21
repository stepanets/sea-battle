<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface Players
{
    public function first(): Player;

    public function second(): Player;
}