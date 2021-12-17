<?php

include_once('DBConfig.php');

class Search extends DBConfig
{

    protected $users = [];

    public function __construct($id, $condition)
    {
        $query = "SELECT * FROM `users` WHERE `id` $condition '$id'";

        $mysqli = $this->connection();
        $result = $mysqli->query($query);
        foreach ($result as $row) {
            $this->users[] = $row;
        }
    }

    public function getExampleByIds()
    {
        $objectArray = [];
        foreach ($this->users as $key => $user) {
            $objectUser = new User($user['first_name'], $user['last_name'], $user['dob'], $user['gender'], $user['city'], $user['id']);
            $objectArray[$key] = $objectUser;
        }

        return $objectArray;
    }

    public function deleteExampleByIds()
    {
        $id = 'id';

        foreach($this->users as $user) {
            $query = "DELETE FROM `users` WHERE `users`.`id` = $user[$id]";

            $mysqli = $this->connection();
            $mysqli->query($query);
        }
    }

    public function getUsers()
    {
        return $this->users;
    }

}

