<?php

$con = mysqli_connect("localhost", "root", "", "bd");

if (!$con) {
    echo mysqli_connect_error();
}
