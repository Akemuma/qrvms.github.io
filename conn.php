<?php

function connect()
{
    $conn = new mysqli("localhost", "root", "", "qrvisitor");
    if (!$conn) die("Database is being upgrade!");
    return $conn;
}
$conn = connect();
if (!$conn) die("Under Construction!");
