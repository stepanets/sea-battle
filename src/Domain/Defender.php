<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface Defender
{
    public function field(): TargetField;
}