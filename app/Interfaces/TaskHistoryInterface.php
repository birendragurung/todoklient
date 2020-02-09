<?php


namespace App\Interfaces;


interface TaskHistoryInterface extends RepositoryInterface
{

    public function findByTaskId(int $taskId);
}
