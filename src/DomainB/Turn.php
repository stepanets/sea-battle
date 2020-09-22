<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace Stepanets\SeaBattle\DomainB;


use Stepanets\SeaBattle\Domain\Player;

final class Turn
{
    public function make(Player $attacker, Player $defender)
    {
        $attacker->shoot($defender);

    }
}