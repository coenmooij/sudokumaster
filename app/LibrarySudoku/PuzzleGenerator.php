<?php

namespace App\LibrarySudoku;

class PuzzleGenerator
{
    const DIFFICULTY_LEVELS = [
        ['level' => 1, 'holes' => 30, 'bound' => 5],
        ['level' => 2, 'holes' => 40, 'bound' => 4],
        ['level' => 3, 'holes' => 50, 'bound' => 3],
        ['level' => 4, 'holes' => 60, 'bound' => 2],
        ['level' => 5, 'holes' => 70, 'bound' => 0],
    ];

    /**
     * Difficulty level.
     *
     * @var integer
     */
    private $difficulty;

    /**
     * A list of cell locations to be dug out.
     *
     * @var array
     */
    private $stack;

    /**
     * The sudoku grid.
     *
     * @var SudokuGrid
     */
    private $sudokuGrid;

    /**
     * The dig consultant.
     *
     * @var DigConsultant
     */
    private $digConsultant;

    /**
     * PuzzleGenerator constructor.
     */
    public function __construct()
    {
        $this->digConsultant = new DigConsultant();
    }

    /**
     * Generate a sudoku puzzle from a given solution.
     *
     * @param SudokuGrid $sudokuGrid A full sudoku solution.
     * @param integer    $difficulty The difficulty level.
     *
     * @return SudokuPuzzle
     */
    public function generatePuzzle(SudokuGrid $sudokuGrid, $difficulty)
    {
        $this->sudokuGrid = $sudokuGrid;
        $this->difficulty = $difficulty;
        $this->populateRandomStack();
        $this->digHoles();

        return new SudokuPuzzle($this->sudokuGrid);
    }

    /**
     * Populates the stack with a list of random cell values.
     *
     * @return void
     */
    private function populateRandomStack()
    {
        $numberOfHoles = self::DIFFICULTY_LEVELS[$this->difficulty - 1]['holes'];
        for ($i = 0; $i < $numberOfHoles; $i++) {
            $this->stack[] = ['x' => rand(0, 8), 'y' => rand(0, 8)];
        }
    }

    /**
     * Empty all the cells from stack in the grid if possible.
     *
     * @return void
     */
    private function digHoles()
    {
        $numberOfHoles = self::DIFFICULTY_LEVELS[$this->difficulty - 1]['holes'];
        $bound = self::DIFFICULTY_LEVELS[$this->difficulty - 1]['bound'];
        for ($i = 0; $i < $numberOfHoles; $i++) {
            if ($this->digConsultant->isSolvableAfterDigging($this->sudokuGrid, $this->stack[$i], $bound)) {
                $this->sudokuGrid->emptyCell($this->stack[$i]['y'], $this->stack[$i]['x']);
            }
        }
    }
}
