<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbHelpYourself";

// Create connection
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
create TABLE professionisti(
    id int PRIMARY KEY,
	nome varchar(50),
	cognome varchar(50),
    societa varchar(50) UNIQUE,
    valutazione int CHECK (valutazione in (1,2,3,4,5)),
    settore varchar(50) CHECK (settore in ("idraulico", "elettricista", "fallito")),
    provincia varchar(50) CHECK (provincia in ("to", "cn", "vc", "bl", "pd", "tv")),
    giorni varchar(50) CHECK (giorni in ("lun", "mar", "mer", "gio", "ven", "sab")),
    orarioInizio time,
    orarioFine time
)
*/


?>

