<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace Stepanets\SeaBattle\Domain;


final class GenericAttacker implements Attacker
{
    /**
     * @var Target
     */
    private $target;

    public function __construct(Target $target, Map $map)
    {
        $this->target = $target;
    }

    public function shoot(Defender $enemy): void
    {
        $enemy->handleShoot()
    }
}