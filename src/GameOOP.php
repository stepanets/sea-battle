<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


use Exception;
use RuntimeException;
use Stepanets\SeaBattle\Domain\Media;
use Stepanets\SeaBattle\Domain\Players;

final class GameOOP
{
    /**
     * @var Media
     */
    private Media $media;
    /**
     * @var Players
     */
    private Players $players;

    public function __construct(Players $players, Media $media)
    {
        $this->media = $media;
        $this->players = $players;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $human = $this->players->one();
        $human->field()->draw($this->media, 'Player field');
        $cpu = $this->players->two();
        $cpu->field()->draw($this->media, 'CPU field');

        $i = 0;
        while (true) {
            $human->shoot($cpu);
            $cpu->field()->draw($this->media, 'After Player shoot');
            if ($cpu->field()->allDestroyed()) {
                echo "The winner is Player\n";
                return;
            }

            $cpu->shoot($human);
            $human->field()->draw($this->media, 'After CPU shoot');
            if ($human->field()->allDestroyed()) {
                echo "The winner is CPU\n";
                return;
            }

            if (++$i === 1000000) {
                throw new RuntimeException('Infinite loop occurred');
            }
        }
    }
}