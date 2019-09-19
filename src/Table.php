<?php

namespace Tnt\ConsoleTable;

use Oak\Contracts\Console\OutputInterface;

class Table
{
    /**
     * @var OutputInterface $output
     */
    private $output;

    /**
     * @var array $headers
     */
    private $headers = [];

    /**
     * @var array $rows
     */
    private $rows = [];

    /**
     * Table constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param string $header
     */
    public function addHeader(string $header)
    {
        $this->headers[] = $header;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * @param array $row
     */
    public function addRow(array $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @param array $columnWidths
     */
    private function drawHorizontalBorder(array $columnWidths)
    {
        foreach ($this->headers as $i => $header) {
            $this->output->write('+-', 1);
            $this->output->write(str_repeat('-', $columnWidths[$i]+1), 1);
        }
        $this->output->write('+', 1);
        $this->output->newline();
    }

    /**
     * @param array $columnWidths
     */
    private function drawHeader(array $columnWidths)
    {
        foreach ($this->headers as $i => $header) {
            $this->output->write('| ', 1);
            $this->output->write(str_pad(strtoupper($header), $columnWidths[$i]+1), 1);
        }
        $this->output->write('|', 1);
        $this->output->newline();
    }

    /**
     * @param array $row
     * @param array $columnWidths
     */
    private function drawRow(array $row, array $columnWidths)
    {
        foreach ($row as $i => $rowValue) {
            $this->output->write('| ', 1);
            $this->output->write(str_pad($rowValue, $columnWidths[$i]+1));
        }
        $this->output->write('|', 1);
        $this->output->newline();
    }

    public function output()
    {
        // First we determine the width of each column
        $colCount = count($this->headers);
        $colWidths = [];

        for ($i = 0; $i < $colCount; $i++) {
            foreach ($this->rows as $row) {
                $value = $row[$i];
                $colWidths[$i] = max($colWidths[$i] ?? 0, strlen($value));
            }
        }

        $this->drawHorizontalBorder($colWidths);
        $this->drawHeader($colWidths);
        $this->drawHorizontalBorder($colWidths);

        foreach ($this->rows as $row) {
            $this->drawRow($row, $colWidths);
        }

        $this->drawHorizontalBorder($colWidths);
    }
}