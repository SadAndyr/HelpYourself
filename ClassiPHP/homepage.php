<?php
include("../Database/dbConnection.php");
$settore = $provincia = $giorni = $orario1 = $orario2 = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $settore = $_POST['settore'] ?? '';
    $provincia = $_POST['provincia'] ?? '';
    $giorni = $_POST['giorni'] ?? '';
    $orario1 = $_POST['orario1'] ?? '';
    $orario2 = $_POST['orario2'] ?? '';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HelpYourself</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="professionista, idraulico, elettricista, elettrotecnico"> <!--da aggiungere-->
    <meta name="author" content="Asoltanei Andrei, Condello Christian">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ClassiCSS/styleHomePage.css" media="all" />
</head>

<body>
    <div id="contenitore">
        <header>
            <img src="../Assets/LogoLiscio.png" alt="Logo" width="20%" height="auto">
            <img src="../Assets/scritta logo.png" alt="HelpYourself" width="auto" height="100px">
        </header>

        <body>
            <section id="filtri">
                <form id="form_filtri" method="POST" action="">
                    <label for="filtri">Specifica le preferenze:</label>
                    <label for="filtroSettore">Settore:</label>
                    <select name="settore" id="filtroSettore">
                        <option value="" selected></option>
                        <option value="elettrotecnica" <?= $settore == "elettrotecnica" ? "selected" : "" ?>>Elettrotecnica
                        </option>
                        <option value="edilizia" <?= $settore == "edilizia" ? "selected" : "" ?>>Edilizia</option>
                        <option value="idraulica" <?= $settore == "idraulica" ? "selected" : "" ?>>Idraulica</option>
                        <option value="fallito" <?= $settore == "fallito" ? "selected" : "" ?>>Fallito</option>
                    </select>

                    <label for="filtroProvincia">Provincia:</label>
                    <select name="provincia" id="filtroProvincia">
                        <option value="" selected></option>
                        <option value="to" <?= $provincia == "to" ? "selected" : "" ?>>Torino</option>
                        <option value="cn" <?= $provincia == "cn" ? "selected" : "" ?>>Cuneo</option>
                        <option value="vc" <?= $provincia == "vc" ? "selected" : "" ?>>Vercelli</option>
                        <option value="bl" <?= $provincia == "bl" ? "selected" : "" ?>>Belluno</option>
                        <option value="pd" <?= $provincia == "pd" ? "selected" : "" ?>>Padova</option>
                        <option value="tv" <?= $provincia == "tv" ? "selected" : "" ?>>Treviso</option>
                    </select>

                    <label for="filtroGiorni">Giorno:</label>
                    <select name="giorni" id="filtroGiorni">
                        <option value="" selected></option>
                        <option value="lun" <?= $giorni == "lun" ? "selected" : "" ?>>Lunedì</option>
                        <option value="mar" <?= $giorni == "mar" ? "selected" : "" ?>>Martedì</option>
                        <option value="mer" <?= $giorni == "mer" ? "selected" : "" ?>>Mercoledì</option>
                        <option value="gio" <?= $giorni == "gio" ? "selected" : "" ?>>Giovedì</option>
                        <option value="ven" <?= $giorni == "ven" ? "selected" : "" ?>>Venerdì</option>
                        <option value="sab" <?= $giorni == "sab" ? "selected" : "" ?>>Sabato</option>
                    </select>

                    <label for="orario">Inserisci un orario (hh:mm):</label>
                    <input type="time" name="orario1" id="orario1" value="<?= $orario1 ?>">
                    <input type="time" name="orario2" id="orario2" value="<?= $orario2 ?>">

                    <button type="submit">Applica filtri</button>
                </form>
            </section>
            <section id="tabella_professionisti">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Società</th>
                        <th>Valutazione</th>
                        <th>Prenotazione <br> veloce</th> <!--genera una finestra di conferma-->
                    </tr>
                    <?php

                    //creazione clausola where con filtri
                    $filtri = [
                        "settore" => $settore,
                        "provincia" => $provincia,
                        "giorni" => $giorni,
                        "orarioInzio" => $orario1,
                        "orarioFine" => $orario2,
                    ] ;
                    $condizioni = [];
                    foreach ($filtri as $campo => $value) {
                        if (isset($value) && $value != '') {
                            $condizioni[] = "$campo = \"$value\"";
                        }
                    }
                    $clausola= implode(" AND ", $condizioni);
                    $where= "WHERE ".$clausola;
                    $query= "SELECT nome, cognome, societa, valutazione FROM professionisti ".(($clausola <> "") ? $where : "");  
                    echo($query);
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["nome"]; ?></td>
                        <td><?php echo $row["cognome"]; ?></td>
                        <td><?php echo $row["societa"]; ?></td>
                        <td><?php echo $row["valutazione"]; ?></td>
                    </tr>
                    <?php
                        }
                    ?>

                </table>
            </section>
    </div>
</body>

</html>