<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Asoltanei Andrei, Condello Christian">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ClassiCSS/style.css">
    <title>Accesso</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php

            include("../Database/dbConnection.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
                $redirect = "";
                $found = false;

                // Controlla prima nella tabella clienti
                $result = mysqli_query($conn, "SELECT * FROM clienti WHERE email='$email'") or die("Select Error");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $found = true;
                    $redirect = "homepage.php";
                }
                // Se non trovato in clienti, controlla in professionisti
                else {
                    $result = mysqli_query($conn, "SELECT * FROM professionisti WHERE email='$email'") or die("Select Error");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $found = true;
                        $redirect = "ProfessionistaHomePage.php";
                    }
                }

                if ($found) {
                    if ($row['pwd'] === $pwd) {
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['nome'] = $row['nome'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['valid'] = true;
                        header("Location: $redirect");
                        exit();
                    } else {
                        $error = "Password errata";
                    }
                } else {
                    $error = "Email non trovata";
                }

                if (isset($error)) {
                    echo "<div class='message'>
                      <p>" . $error . "</p>
                       </div> <br>";
                    echo "<a href='accesso.php'><button class='btn'>Torna Indietro</button>";
                }
            } else {
                ?>
                <header>Accedi al tuo account</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Non hai un account? <a href="registrazione.php">Registrati ora!</a>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>