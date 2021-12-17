<?php

include_once('DBConfig.php');

class User extends DBConfig
{

    public $id;
    public $firstName;
    public $lastName;
    /**
     * format date 2000-12-30
     */
    public $dob;
    public $gender;
    public $city;

    public function __construct($firstName, $lastName, $dob, $gender, $city, $id = NULL)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dob = $dob;
        $this->gender = $gender;
        $this->city = $city;
        $this->id = $id;
    }

    public function saveToDB()
    {

        $query = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `dob`, `gender`, `city`)
                    VALUES (NULL, '$this->firstName', '$this->lastName', '$this->dob', '$this->gender', '$this->city')";

        $mysqli = $this->connection();
        $mysqli->query($query);

    }

    public function getUserById($id)
    {

        $query = "SELECT * FROM `users` WHERE `id` = '$id'";

        $mysqli = $this->connection();
        $user = $mysqli->query($query);

        return $user->fetch_row();
    }

    public function deleteUserById($id)
    {
        $query = "DELETE FROM `users` WHERE `users`.`id` = '$id'";

        $mysqli = $this->connection();
        $mysqli->query($query);
    }

    public static function getAge($user)
    {
        $date = $user[3];

        $tz = new DateTimeZone('Europe/Brussels');
        $age = DateTime::createFromFormat('Y-d-m', $date, $tz)
            ->diff(new DateTime('now', $tz))
            ->y;

        return $age;
    }

    public static function getGender($user)
    {
        return $user[4] ? 'male' : 'female';
    }

    public function editGender($user, $gender)
    {
        $id = $user[0];

        $query = "UPDATE `users` SET `gender` = '$gender' WHERE `users`.`id` = '$id'";
        $mysqli = $this->connection();
        $mysqli->query($query);

        return new User($this->firstName, $this->lastName, $this->dob, $this->gender, $this->city);
    }

    public function editDate($user, $date)
    {
        $id = $user[0];

        $query = "UPDATE `users` SET `dob` = '$date' WHERE `users`.`id` = '$id'";
        $mysqli = $this->connection();
        $mysqli->query($query);

        return new User($this->firstName, $this->lastName, $this->dob, $this->gender, $this->city);
    }

    /**
     * Возвращает массив со всеми пользователями
     */
    public function getCollection()
    {
        $query = "SELECT * FROM `users`";

        $mysqli = $this->connection();

        $count = 0;
        if ($data = $mysqli->query($query)) {
            foreach ($data as $row) {
                $this->data[$count] = $row;
                $count++;
            }

            return $this->data;
        }
    }

}

