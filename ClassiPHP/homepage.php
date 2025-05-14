<!DOCTYPE html>
<html>

<head>
    <title>HelpYourself</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="professionista, idraulico, elettricista, elettrotecnico" > <!--da aggiungere-->
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
        <section id="filtri">
            <form id="form_filtri">
                <label for="filtri">Specifica le preferenze:</label>
                <select name="menu1" id="filtro 1" >
                    <option value="opzione1">1</option>
                    <option value="opzione2">2</option>
                    <option value="opzione3">3</option>
                </select>
                <select name="menu2" id="filtro 2" >
                    <option value="opzione1">1</option>
                    <option value="opzione2">2</option>
                    <option value="opzione3">3</option>
                </select>
                <select name="menu3" id="filtro 3" >
                    <option value="opzione1">1</option>
                    <option value="opzione2">2</option>
                    <option value="opzione3">3</option>
                </select>
                <select name="menu4" id="filtro 4" >
                    <option value="opzione1">1</option>
                    <option value="opzione2">2</option>
                    <option value="opzione3">3</option>
                </select>
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
                $conn = new mysqli("localhost","root","","");
                
                
                ?>
            </table>
        </section>
    </div>
</body>

</html>