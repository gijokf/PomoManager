<?php

namespace PomoManager\Entity;

use PomoConfig\Connection\Connect;

class User extends Connect
{
    private string $table;
    private int $userID;
    private string $userName;
    private string $userPassword;
    private string $userAvatar;
    private ?int $userExperience = 0;

    function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    /**
     * @param string $userPassword
     */
    public function setUserPassword(string $userPassword): void
    {
        $this->userPassword = $userPassword;
    }

    /**
     * @return string
     */
    public function getUserAvatar(): string
    {
        return $this->userAvatar;
    }

    /**
     * @param string $userAvatar
     */
    public function setUserAvatar(string $userAvatar): void
    {
        $this->userAvatar = $userAvatar;
    }

    /**
     * @return int
     */
    public function getUserExperience(): int
    {
        return $this->userExperience;
    }

    /**
     * @param int $userExperience
     */
    public function setUserExperience(int $userExperience): void
    {
        $this->userExperience = $userExperience;
    }

    //Calcula o XP
    public function calcXP($L, $const)
    {
        $XPsqrt = ($L - 1) / $const;
        $XP = $XPsqrt * $XPsqrt;
        return $XP;
    }

    //Calcula o level
    public function calcLevel($XP, $const)
    {
        $L = floor(1 + sqrt($XP) * $const);
        return $L;
    }

    //XP para o próximo level
    public function xpToNextLevel($L, $const)
    {
        $XPNsqrt = ($L) / $const;
        $XPsqrt = ($L - 1) / $const;
        return ($XPNsqrt * $XPNsqrt) - ($XPsqrt * $XPsqrt);
    }

}