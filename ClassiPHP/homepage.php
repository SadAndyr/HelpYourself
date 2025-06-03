<?php
session_start();
include("../Database/dbConnection.php");
$settore = $provincia = $giorni = $orario = "";

// Gestione del form di prenotazione PRIMA di qualsiasi output HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Elaborazione prenotazione
        $idProfessionista = $_POST['idProfessionista'];
        $giorni = $_POST['giorni'] ?? null;
        $orario = $_POST['orario'] ?? null;
        $provincia = $_POST['provincia'] ?? null;

        $stmt = $conn->prepare("INSERT INTO prenotazioni (idCliente, idProfessionista, giorno, ora, provincia) VALUES (3, ?, ?, ?, ?)");
        $stmt->bind_param("isss", $idProfessionista, $giorni, $orario, $provincia);

        if ($stmt->execute()) {
            $_SESSION['show_confirmation'] = true;
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        // Elaborazione filtri
        $settore = $_POST['settore'] ?? '';
        $provincia = $_POST['provincia'] ?? '';
        $giorni = $_POST['giorni'] ?? '';
        $orario = $_POST['orario'] ?? '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HelpYourself</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="professionista, idraulico, elettricista, elettrotecnico">
    <meta name="author" content="Asoltanei Andrei, Condello Christian">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ClassiCSS/styleHome.css" media="all" />
    
</head>
<body>
    <div id="contenitore">
        <header>
            <img id="Logo" src="../Risorse/Grafica/LogoPlain.png" alt="Logo" width="20%" height="auto">
            <img src="../Risorse/Grafica/LogoScritta.png" alt="HelpYourself" width="auto" height="100px">
        </header>
        <fieldset>
            <legend id="filtri">Seleziona i dettagli della prenotazione:</legend>    
            <form id="form_filtri" method="POST" action="">
                <label for="filtroSettore">Settore:</label>
                <select name="settore" id="filtroSettore">
                    <option value="" selected></option>
                    <option value="elettrotecnica" <?= $settore == "elettrotecnica" ? "selected" : "" ?>>Elettrotecnica</option>
                    <option value="edilizia" <?= $settore == "edilizia" ? "selected" : "" ?>>Edilizia</option>
                    <option value="idraulica" <?= $settore == "idraulica" ? "selected" : "" ?>>Idraulica</option>
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
                <input type="time" name="orario" id="orario" value="<?= $orario ?>">
                <button type="submit">Applica filtri</button>
            </form>
        </fieldset>

        <?php if (isset($_SESSION['show_confirmation'])): ?>
        <div class="confirmation-banner">
            Richiesta inviata con successo!
            <button onclick="this.parentElement.remove()" style="
                background: none;
                border: none;
                color: white;
                font-weight: bold;
                cursor: pointer;
            ">X</button>
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.confirmation-banner')?.remove();
            }, 3000);
        </script>
        <?php unset($_SESSION['show_confirmation']); ?>
        <?php endif; ?>

        <section id="tabella_professionisti">
            <table class="tabella-stilizzata">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Telefono</th>
                        <th>Valutazione</th>
                        <th>Prenotazione <br> veloce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Creazione clausola where con filtri
                    $filtri = [
                        "settore" => $settore,
                        "provincia" => $provincia,
                        "giorni" => $giorni
                    ];
                    $ora = ($orario != "") ? "orarioInizio < \"$orario.00\" AND orarioFine > \"$orario.00\"" : "";
                    $condizioni = [];
                    foreach ($filtri as $campo => $value) {
                        if (isset($value) && $value != '') {
                            $condizioni[] = "$campo = \"$value\"";
                        }
                    }
                    if($ora != ""){
                        $condizioni[] = $ora;
                    }
                    $clausola = implode(" AND ", $condizioni);
                    $where = "WHERE ".$clausola;
                    $query = "SELECT p.*, AVG(r.valutazione) as valutazione FROM professionisti p LEFT JOIN recensioni r on p.id=r.idProfessionista ".(($clausola <> "") ? $where : "")." GROUP BY p.id";
                    
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <tr onclick="window.location.href='logIN.php'" style='cursor:pointer;'>
                        <td><?= htmlspecialchars($row["nome"]) ?></td>
                        <td><?= htmlspecialchars($row["cognome"]) ?></td>
                        <td><?= htmlspecialchars($row["telefono"]) ?></td>
                        <td><?= ($row["valutazione"] != null) ? number_format($row["valutazione"],1) : "---" ?></td>
                        <td class="CellaPrenotazione" onclick="event.stopPropagation();">
                            <form method="POST" action="">
                                <input type="hidden" name="idProfessionista" value="<?= $row["id"] ?>">
                                <input type="hidden" name="giorni" value="<?= htmlspecialchars($giorni ?? '') ?>">
                                <input type="hidden" name="orario" value="<?= htmlspecialchars($orario ?? '') ?>">
                                <input type="hidden" name="provincia" value="<?= htmlspecialchars($provincia ?? '') ?>">
                                <input class="bottone" type="submit" name="submit" value="Richiedi Assistenza">
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>