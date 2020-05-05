<?php

$c = mysqli_connect('localhost', 'user_name', 'pass', 'database_name');

if (! $c) {
    die('Error to connect');
}