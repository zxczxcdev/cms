<?php
$connectdb = mysqli_connect('localhost','root','','cms');
if (!$connectdb) {
    # code...
    die("Error connect to DB");
}
