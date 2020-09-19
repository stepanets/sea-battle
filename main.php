<?php declare(strict_types=1);

use Stepanets\SeaBattle\Application\ConsoleMedia;
use Stepanets\SeaBattle\GameOOP;

require_once __DIR__.'/vendor/autoload.php';


(new GameOOP(
    new ConsoleMedia()
))->run();