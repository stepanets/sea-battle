<?php declare(strict_types=1);
/**
 * @author Pavel Stepanets <pahhan.ne@gmail.com>
 */

namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Matrix;

interface Target
{
    public function coordinate(Matrix $map): Coordinate;
}