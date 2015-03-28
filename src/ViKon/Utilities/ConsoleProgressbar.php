<?php

namespace ViKon\Utilities;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class ConsoleProgress
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Utilities
 */
trait ConsoleProgressbar {
    /** @var int */
    protected $progressCurrent = 0;

    /** @var int */
    protected $progressMax = 0;

    /** @var null|int */
    protected $startTime = null;

    public function initProgressbar() {
        $formatter = $this->output->getFormatter();
        $formatter->setStyle('strong', new OutputFormatterStyle('green', null, ['bold']));
        $formatter->setStyle('progress', new OutputFormatterStyle(null, 'black', ['conceal']));
    }

    /**
     * Set max entry count to progressbar
     *
     * @param int $progressMax
     */
    public function setProgressMax($progressMax) {
        $this->progressMax = $progressMax;
    }

    /**
     * Reset progress and output text as progressbar header
     *
     * @param null|string $text header text
     */
    public function startProgress($text = null) {
        $this->startTime = microtime(true);
        $this->progressCurrent = 0;
        if ($text !== null) {
            $this->output->writeln($text);
        }
        $this->output->write('<info>Loading...</info>');
    }

    /**
     * Reset progressbar
     */
    public function resetProgressbar() {
        $this->progressCurrent = 0;
    }

    /**
     * Make progress on progressbar
     */
    public function progress() {
        $this->progressCurrent++;

        $percentage = ($this->progressCurrent / $this->progressMax) * 100;

        $currentTime = microtime(true);
        $reamingTime = (($currentTime - $this->startTime) / $this->progressCurrent) * ($this->progressMax - $this->progressCurrent);

        $formattedPercentage = str_pad(number_format(floor($percentage * 100) / 100, 2), 6, ' ', STR_PAD_LEFT) . '%';
        $formattedCurrent = number_format($this->progressCurrent);
        $formattedMax = number_format($this->progressMax);

        $filledBar = '<progress>' . str_pad('', floor($percentage / 2), '#') . '</progress>';
        $emptyBar = str_pad('', 50 - floor($percentage / 2), '-');

        $progressbar = "\r" . $filledBar . $emptyBar;
        $progress = $formattedPercentage . ' (' . $formattedCurrent . '/' . $formattedMax . ') (' . date('H:i:s', $reamingTime) . ')';

        $this->output->write($progressbar . ' ' . $progress, $this->progressCurrent == $this->progressMax);
    }

}