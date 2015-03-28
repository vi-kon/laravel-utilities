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
        $this->progressCurrent = 0;
        if ($text !== null) {
            $this->output->writeln($text);
        }
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

        $progressbar = "\r" . '<progress>' . str_pad('', floor($percentage / 2), '#') . '</progress>' .
            str_pad('', 50 - floor($percentage / 2), '-');

        $progress = str_pad(number_format(floor($percentage * 100) / 100, 2), 6, ' ', STR_PAD_LEFT) . '%' . ' (' .
            number_format($this->progressCurrent) . '/' . number_format($this->progressMax) . ')';

        $this->output->write($progressbar . ' ' . $progress, $this->progressCurrent == $this->progressMax);
    }

}