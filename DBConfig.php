<?php

class DBConfig
{

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'users';

    protected function connection()
    {
        $mysqli = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if($mysqli->connect_error) {
            die('Connection failed' . $mysqli->connect_error);
        } else {

           return $mysqli;
        }
    }
}