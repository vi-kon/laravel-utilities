<?php


namespace ViKon\Utilities;

use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class Seeder extends \Seeder
{
    public function setCommand(Command $command)
    {
        parent::setCommand($command);

        $output    = $this->command->getOutput();
        $formatter = $output->getFormatter();
        $formatter->setStyle('strong', new OutputFormatterStyle('green', null, array('bold')));
        $formatter->setStyle('progress', new OutputFormatterStyle(null, 'black', array('conceal')));
    }

    public function seedingTable($table)
    {
        $output = $this->command->getOutput();

        $output->writeln('');
        $output->writeln('<strong>Seeding table:</strong> ' . $table);
    }

    public function progressbar($current, $max)
    {
        $output = $this->command->getOutput();

        $percentage = ($current / $max) * 100;

        $progressbar = "\r" . '<progress>' . str_pad('', floor($percentage / 2), ' ') . '</progress>'
                       . str_pad('', 50 - floor($percentage / 2), ' ');
        $progress    = str_pad(number_format(floor($percentage * 100) / 100, 2), 6, ' ', STR_PAD_LEFT) . '%'
                       . ' (' . number_format($max) . '/' . number_format($current) . ')';
        $output->write($progressbar . ' ' . $progress, $current == $max);
    }
} 