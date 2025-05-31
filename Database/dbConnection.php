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
    provincia varchar(2) CHECK (provincia in ("to", "cn", "vc", "bl", "pd", "tv")),
    giorni varchar(3) CHECK (giorni in ("lun", "mar", "mer", "gio", "ven", "sab")),
    orarioInizio time,
    orarioFine time
)    

    CREATE TABLE clienti (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50),
    cognome VARCHAR(50) ,
    telefono VARCHAR(10) ,
    email VARCHAR(50)
);

CREATE TABLE prenotazioni (
    idCliente INT(11),
    idProfessionista INT(11),
    giorno VARCHAR(3) ,
    ora TIME ,
    provincia VARCHAR(2) ,
FOREIGN KEY (idCliente) REFERENCES clienti(id),
FOREIGN KEY (idProfessionista) REFERENCES professionisti(id)
);

create table recensioni(
id int PRIMARY KEY AUTO_INCREMENT,
    idCliente int,
    idProfessionista int,
    contenuto text,
    valutazione DECIMAL(2,1) CHECK (valutazione >= 0 AND valutazione <= 5),
    FOREIGN KEY (idCliente) REFERENCES clienti(id),
    FOREIGN KEY (idProfessionista) REFERENCES professionisti(id)
);

Clienti(_id_, nome, cognome, telefono, email);
    Professionisti(_id_, Piva, nome, cognome, email, telefono, settore,  provincia, giorni, orarioInizio, orarioFine);
    Prenotazioni(_idcliente, idprofessionista_, giorno, ora, provincia);
    Recensioni(id, idCliente, idProfessionista, contenuto, valutazione);
*/

?>

