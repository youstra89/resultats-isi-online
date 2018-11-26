<?php
    require('connexion.inc.php');
    //include "connexion.inc.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ISI Abidjan | Résultats d'examen ISI Première session 2018-2019</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    </head>
    <body>
        <div class="ui attached large stackable menu">
          <div class="ui container">
            <a class="item" href="index.php">
              <i class="home icon"></i> Accueil
            </a>
            <a class="item" href="abidjan.php">
              <i class="grid layout icon"></i> Abidjan
            </a>
            <a class="item" href="agboville.php">
              <i class="grid layout icon"></i> Agboville
            </a>
            
            <div class="right item">
              <div class="ui simple dropdown item">
              Plus
              <i class="dropdown icon"></i>
              <div class="menu">
                <a class="item"><i class="edit icon"></i> Edit Profile</a>
                <a class="item"><i class="globe icon"></i> Choose Language</a>
              </div>
            </div>
            </div>
          </div>
        </div>
        
        <br>
        <div class="ui container">
            <div class="ui red message" style="z-index: 1; position: fixed; display: none;" width="100%">
                <i class="close icon"></i>
                <strong>Attention!!!</strong>
                <p>La classe ne doit pas être vide. Veuillez sélectionnez une classe avant de poursuivre.</p>
            </div>
        </div>
        <div class="ui container" style="position: relative; z-index: 0;">
            
            <div class="ui raised very padded text segment">
                <center>
                    <h2 class="ui center header" style="font-size: 4rem; color: teal">Institut des Sciences Islamiques <br>ABIDJAN</h2>
                </center>
            </div>
            <div class="ui raised very padded text segment">
                <h2 class="ui center header">En quelle classe êtes-vous ?</h2>
                <br>
                <?php
                    if(isset($_POST['sms']))
                    {
                        if(!empty($_POST['classe']))
                        {
                            //echo "<script>alert('".$_POST['classe']."');</script>";
                            echo "<script>document.location.replace('saisie-matricule.php?classe=".$_POST['classe']."');</script>";
                        }
                    }
                ?>
                <form class="ui form" method="post" action="" id="classe-form">
                    <h4 class="ui dividing header">Sélectionnez le regime de formation, puis le niveau et en fin votre classe</h4>
                    <div class="three fields">
                        <div class="field">
                            <label for="regime">Regime de formation</label>
                            <select class="ui fluid dropdown" id="regime" name="regime" required>
                                <option value="">Choisissez votre regime</option>
                                <option value="1">Academie</option>
                                <option value="2">Centre de formation</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="niveau">Niveau</label>
                            <select class="ui fluid dropdown" id="niveau" name="niveau" required>
                                <option value="">Choisissez votre niveau</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="classe">Classe</label>
                            <select class="ui fluid dropdown" id="classe" name="classe">
                                <option value="">Choisissez votre classe</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="field">
                        <button class="negative ui button" name="sms" id="sms-classe"><i class="send icon"></i> Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
