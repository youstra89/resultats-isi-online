<?php
  $lang = empty($_GET['lang']) ? 'fr' : $_GET['lang'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Vous pouvez désormais voir vos résultats d'examen en ligne sur le site de l'Institut des Sciences Islamiques">
        <title>Résultats d'examen ISI Première session 2018-2019</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    </head>
    <body>
        <div class="ui attached large stackable menu">
          <div class="ui container">
            <a class="item" href="index-<?php echo $lang; ?>.php">
              <i class="home icon"></i> Accueil
            </a>
            <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=0">
              <i class="grid layout icon"></i> Abidjan
            </a>
            <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=1">
              <i class="grid layout icon"></i> Agboville
            </a>

            <div class="right item">
              <div class="ui simple dropdown item">
              Changer langue
                <i class="dropdown icon"></i>
                <div class="menu">
                  <a class="item" href="index-fr.php"><i class="globe icon"></i> Français</a>
                  <a class="item" href="index-ar.php"><i class="globe icon"></i> العربية</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="ui container">
            <div class="ui raised very padded text segment center">
              <h2 class="ui header">Les résultasts de l'examen de la première session 2018-2019 à l'Institut des Sciences Islamiques</h2>
              <p>Si vous êtes un élève de l'institut à Abidjan, veuillez cliquer sur "Abidjan" dans le menu principal.</p>
              <p>Sinon, si vous êtes à Agboville, cilquez plutôt sur Agboville dans le menu principal.</p>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
    </body>
</html>
<?php

?>
