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
    id int PRIMARY KEY AUTO_INCREMENT,
	Piva varchar(11) UNIQUE,
    nome varchar(50),
	cognome varchar(50),
    email varchar(50),
    telefono varchar(10),
    settore varchar(50) CHECK (settore in ("Idraulica", "Elettrotecnica", "Edilizia")),
    provincia varchar(50) CHECK (provincia in ("to", "cn", "vc", "bl", "pd", "tv")),
    giorni varchar(50) CHECK (giorni in ("lun", "mar", "mer", "gio", "ven", "sab")),
    orarioInizio time,
    orarioFine time
)    

    Clienti(_id_, nome, cognome, telefono, email);
    Professionisti(_id_, Piva, nome, cognome, email, telefono, settore,  provincia, giorni, orarioInizio, orarioFine);
    Prenotazioni(_idcliente, idprofessionista_, giorno, ora, provincia);


*/


?>

