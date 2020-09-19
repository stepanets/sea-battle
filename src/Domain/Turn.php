<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


final class Turn
{
    public function make(Player $player, TargetField $targetField, ResultField $resultField): TurnResult
    {
        ($result = $targetField->handleShoot(
            $player->shoot()
        ))->apply($resultField);

        return $result;
    }
}