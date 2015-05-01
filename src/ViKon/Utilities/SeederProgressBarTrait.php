<?php

namespace ViKon\Utilities;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SeederProgressBarTrait
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Utilities
 */
trait SeederProgressBarTrait {

    /**
     * Create progressbar
     *
     * @return \Symfony\Component\Console\Helper\ProgressBar
     */
    protected function createProgressBar() {
        /** @var OutputInterface $output */
        /** @noinspection PhpUndefinedFieldInspection */
        $output = $this->command->getOutput();
        $output->writeln('');
        /** @noinspection PhpUndefinedFieldInspection */
        $dimensions = $this->command->getApplication()->getTerminalDimensions();
        $progress = new ProgressBar($output, $dimensions[0]);
        $progress->setFormat('Seeding: <info>' . get_called_class() . "</info>\n%current:4s%/%max:-4s% [%bar%] %percent:4s%% %elapsed:6s%/%estimated:-6s%");

        return $progress;
    }
}