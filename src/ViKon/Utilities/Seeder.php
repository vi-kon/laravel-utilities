<?php


namespace ViKon\Utilities;

use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class Seeder
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Utilities
 */
class Seeder extends \Illuminate\Database\Seeder {

    /** @var int */
    protected $currentEntryCount = 0;

    /** @var int */
    protected $maxEntryCount = 0;

    public function setCommand(Command $command) {
        parent::setCommand($command);

        $output = $this->command->getOutput();
        $formatter = $output->getFormatter();
        $formatter->setStyle('strong', new OutputFormatterStyle('green', null, ['bold']));
        $formatter->setStyle('progress', new OutputFormatterStyle(null, 'black', ['conceal']));
    }

    /**
     * Start seeding new table
     *
     * @param string $table table name
     */
    public function startTable($table) {
        $output = $this->command->getOutput();

        $output->writeln('');
        $output->writeln('<strong>Seeding table:</strong> ' . $table);
    }

    /**
     * Set entry count for new table
     *
     * @param int $max maximum entry count
     */
    public function setMaxEntryCount($max) {
        $this->currentEntryCount = 0;
        $this->maxEntryCount = $max;
    }

    /**
     * Add new entry
     */
    public function addEntry() {
        $this->currentEntryCount++;

        $output = $this->command->getOutput();

        $percentage = ($this->currentEntryCount / $this->maxEntryCount) * 100;

        $progressbar = "\r" . '<progress>' . str_pad('', floor($percentage / 2), ' ') . '</progress>' .
            str_pad('', 50 - floor($percentage / 2), ' ');
        $progress = str_pad(number_format(floor($percentage * 100) / 100, 2), 6, ' ', STR_PAD_LEFT) . '%' . ' (' .
            number_format($this->maxEntryCount) . '/' . number_format($this->currentEntryCount) . ')';
        $output->write($progressbar . ' ' . $progress, $this->currentEntryCount == $this->maxEntryCount);
    }
}