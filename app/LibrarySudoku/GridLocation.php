<?php

namespace App\LibrarySudoku;

class GridLocation
{
    /** @var int */
    private $row;

    /** @var int */
    private $column;

    public function __construct(int $row, int $column)
    {
        $this->row = $row;
        $this->column = $column;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }
}