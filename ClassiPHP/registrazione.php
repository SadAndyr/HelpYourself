<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Asoltanei Andrei, Condello Christian">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ClassiCSS/style.css">
    <title>Registrazione</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">

            <?php

            include("../Database/dbConnection.php");

            if (isset($_POST['submit'])) {
                $nome_completo = $_POST['nome'];
                $parti_nome = explode(' ', $nome_completo, 3);
                $nome = $parti_nome[0];
                if (isset($parti_nome[1])) {
                    $cognome = $parti_nome[1];
                } else {
                    $cognome = '';
                }

                $email = $_POST['email'];
                $pwd = $_POST['pwd'];
                $tipo = $_POST['tipo'];

                // Verifica se l'email esiste in entrambe le tabelle
                $verify_query = mysqli_query($conn, "SELECT email FROM clienti WHERE email='$email' UNION SELECT email FROM professionisti WHERE email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                      <p>Mail già utilizzata. Perfavore provane un'altra!</p>
                  </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Torna Indietro</button></a>";
                } else {
                    if ($tipo == "Cliente") {
                        mysqli_query($conn, "INSERT INTO clienti(nome,cognome,email,pwd) VALUES('$nome','$cognome','$email','$pwd')") or die("Errore durante la registrazione del Cliente");
                    } elseif ($tipo == "Professionista") {
                        mysqli_query($conn, "INSERT INTO professionisti(nome,cognome,email,pwd) VALUES('$nome','$cognome','$email','$pwd')") or die("Errore durante la registrazione del Professionista");
                    }

                    echo "<div class='message'>
                      <p>Registrazione Completata!</p>
                  </div> <br>";
                    echo "<a href='accesso.php'><button class='btn'>Accedi ora!</button>";
                }

            } else {

                ?>

                <div class="form-header">
                    <img src="../Risorse/Grafica/LogoPlain.png" class="circle-icon" alt="Logo">
                </div>
                <header>Registrati</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="nome">Nome e Cognome</label>
                        <input type="text" name="nome" id="nome" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Scegli la tipologia:</label>
                        <select id="tipo" name="tipo" required>
                            <option value=""> --- Scegli --- </option>
                            <option value="Cliente">Cliente</option>
                            <option value="Professionista">Professionista</option>
                        </select>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Crea Account" required>
                    </div>

                    <div class="links">
                        Hai già un account? <a href="accesso.php">Accedi</a>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>