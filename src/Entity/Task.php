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

    /**
     * @return int
     */
    public function getTaskID(): int
    {
        return $this->taskID;
    }

    /**
     * @param int $taskID
     */
    public function setTaskID(int $taskID): void
    {
        $this->taskID = $taskID;
    }

    /**
     * @return string
     */
    public function getUserID(): string
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     */
    public function setUserID(string $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getTaskDescription(): string
    {
        return $this->taskDescription;
    }

    /**
     * @param string $taskDescription
     */
    public function setTaskDescription(string $taskDescription): void
    {
        $this->taskDescription = $taskDescription;
    }

    /**
     * @return string
     */
    public function getTaskTier(): string
    {
        return $this->taskTier;
    }

    /**
     * @param string $taskTier
     */
    public function setTaskTier(string $taskTier): void
    {
        $this->taskTier = $taskTier;
    }

    /**
     * @return string
     */
    public function getTaskStart(): string
    {
        return $this->taskStart;
    }

    /**
     * @param string $taskStart
     */
    public function setTaskStart(string $taskStart): void
    {
        $this->taskStart = $taskStart;
    }

    /**
     * @return string
     */
    public function getTaskEnd(): string
    {
        return $this->taskEnd;
    }

    /**
     * @param string $taskEnd
     */
    public function setTaskEnd(string $taskEnd): void
    {
        $this->taskEnd = $taskEnd;
    }

    /**
     * @return int
     */
    public function getTaskExp(): int
    {
        return $this->taskExp;
    }

    /**
     * @param int $taskExp
     */
    public function setTaskExp(int $taskExp): void
    {
        $this->taskExp = $taskExp;
    }


}