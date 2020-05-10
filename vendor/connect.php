<?php

$c = mysqli_connect('localhost', 'user', 'pass', 'db');

if (! $c) {
    die('Error to connect');
}