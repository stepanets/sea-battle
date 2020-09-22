<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Application;


use LucidFrame\Console\ConsoleTable;
use Stepanets\SeaBattle\Domain\Field;
use Stepanets\SeaBattle\Domain\Media;
use function array_merge;
use function array_slice;
use function range;

final class ConsoleMedia implements Media
{
    private const SYMBOLS = [
        '░',
        '▆',
        '╳',
    ];

    public function drawField(array $field, string $title, int $cols): void
    {
        echo $title, "\n";

        $t = (new ConsoleTable())->addRow(
            array_merge(
                ['X'],
                array_slice(
                    range('A', 'Z'),
                    0,
                    $cols
                )
            )
        );
        foreach ($field as $n => $row) {
            $t = $t->addRow()->addColumn($n + 1);
            foreach ($row as $cell) {
                $t->addColumn(self::SYMBOLS[$cell]);
            }
        }
        $t->display();
    }
}