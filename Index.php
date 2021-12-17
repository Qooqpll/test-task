<?php

include_once('User.php');
include_once('Search.php');


$user = new User('Vlad', 'Borovikov', '2002-12-11', '1', 'Belinichi');
$user->saveToDB();
print_r($user::getAge($user->getUserById(139)));