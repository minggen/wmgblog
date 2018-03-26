<?php

class  user{
    private $username;
    private $usernickname;
    private $userpasswd;
    /**
     * @return the $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return the $usernickname
     */
    public function getUsernickname()
    {
        return $this->usernickname;
    }

    /**
     * @return the $userpasswd
     */
    public function getUserpasswd()
    {
        return $this->userpasswd;
    }

    /**
     * @param field_type $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param field_type $usernickname
     */
    public function setUsernickname($usernickname)
    {
        $this->usernickname = $usernickname;
    }

    /**
     * @param field_type $userpasswd
     */
    public function setUserpasswd($userpasswd)
    {
        $this->userpasswd = $userpasswd;
    }
 
    
}