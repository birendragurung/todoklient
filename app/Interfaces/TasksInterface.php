<?php


namespace App\Interfaces;


interface TasksInterface extends RepositoryInterface
{

    public function getTodoList();

	public function taskCountStatistics();

    public function updateStateById(int $id , $state);

    public function taskCountStatisticsForStaff($id);

    public function listTasks();

    public function tasksForUser(int $id);
}
