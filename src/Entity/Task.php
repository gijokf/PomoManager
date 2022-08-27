<?php

namespace PomoManager\Entity;

use PomoConfig\connection\Connect;

class Task extends Connect
{
    private $table;
    private int $taskID;
    private string $userID;
    private string $taskDescription;
    private string $taskTier;
    private string $taskStart;
    private string $taskEnd;
    private int $taskExp;

    function __construct()
    {
        parent::__construct();
        $this->table = 'tasks';
    }


}