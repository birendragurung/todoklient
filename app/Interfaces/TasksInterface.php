<?php


namespace App\Interfaces;


interface TasksInterface extends RepositoryInterface
{

    public function getTodoList();

	public function taskCountStatistics();
}
