<?php
    require('connexion.inc.php');
    $lang = empty($_GET['lang']) ? 'fr' : $_GET['lang'];
    $city = $_GET['city'];
    if($city != 0 && $city != 1)
    echo "<script>document.location.replace('index-".$lang.".php');</script>";
    $classeId = $_GET['classe'];
    if(empty($classeId))
    {
        echo "<script>alert('Vous n\'avez pas sélectionné de classe');</script>";
        echo "<script>document.location.replace('index.php');</script>";
    }
    elseif(!is_numeric($classeId))
    {
        echo "<script>alert('La classe que vous avez envoyée n\'existe pas!');</script>";
        echo "<script>document.location.replace('index.php');</script>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Résultats d'examen ISI Première session 2018-2019</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    </head>
    <body>
      <div class="ui attached large stackable menu">
        <div class="ui container">
          <a class="item" href="index-<?php echo $lang; ?>.php">
            <i class="home icon"></i> Accueil
          </a>
          <a class="item" href="selection-classe-<?php echo $lang; ?>.php?city=0">
            <i class="grid layout icon"></i> Abidjan
          </a>
          <a class="item" href="selection-classe-<?php echo $lang; ?>.php?city=1">
            <i class="grid layout icon"></i> Agboville
          </a>

          <div class="right item">
            <div class="ui simple dropdown item">
            Changer langue
              <i class="dropdown icon"></i>
              <div class="menu">
                <a class="item" href="saisie-matricule-fr.php?lang=fr&city=<?php echo $city; ?>&classe=<?php echo $classeId; ?>"><i class="globe icon"></i> Français</a>
                <a class="item" href="saisie-matricule-ar.php?lang=ar&city=<?php echo $city; ?>&classe=<?php echo $classeId; ?>"><i class="globe icon"></i> العربية</a>
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
                  <h2 class="ui center header" style="font-size: 4rem; color: teal">
                    Institut des Sciences Islamiques <br><?php echo $city == 0 ? 'ABIDJAN' : 'AGBOVILLE'; ?>
                  </h2>
                </center>
            </div>
            <div class="ui raised very padded text segment">
                <h2 class="ui center header">Entrez votre matricule puis valisez pour voir votre résultat</h2>
                <br>
                <?php
                    if(isset($_POST['sms']))
                    {
                        $matricule = $_POST['matricule'];
                        if(!empty($matricule))
                        {
                            // On sélectionne l'élève
                            $sql = "SELECT eleve_id, matricule, nom_ar, pnom_ar, nom_fr, pnom_fr, commune, residence, renvoye FROM eleve WHERE matricule = :matricule";
                            $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute([':matricule' => $matricule]);
                            $eleve = $sth->fetch();

                            // Avant de poursuivre, on vérifie que le matricule saisi existe et appartient à un élève
                            if(empty($eleve)){
                                echo "<script>alert('Le matricule saisi n\'est pas correct!');</script>";
                                echo "<script>document.location.replace('index-".$lang.".php?lang=".$lang."');</script>";
                            }
                            elseif(!empty($eleve) && $eleve[8] == TRUE){
                                echo "<script>alert('Désolé, vous ne faites plus parti des élèves de l\'institut!');</script>";
                                echo "<script>document.location.replace('index-".$lang.".php?lang=".$lang."');</script>";
                            }

                            // Puis on sélectionne la classe
                            $sql = "SELECT classe_id, libelle_classe_fr, libelle_classe_ar FROM classe WHERE classe_id = :classe";
                            $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute([':classe' => $classeId]);
                            $classe = $sth->fetch();

                            // Et enfin, on va sélectionner une occurence de frequenter pour l'id de l'élève et pour l'id de la classe
                            $sql = "SELECT id, annee_scolaire_id, eleve_id, classe_id, redouble FROM frequenter WHERE eleve_id = :eleve AND classe_id = :classe AND annee_scolaire_id = :annee";
                            $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute([':eleve' => $eleve[0], ':classe' => $classeId, ':annee' => 2]);
                            $frequenter = $sth->fetch();

                            //Ici, si $frequenter est vide, cela veut dire que l'élève n'est pas dans la classe dans laquelle il prétend être.
                            // Dans le cas contraire, c'est un élève de la classe
                            if(empty($frequenter)){
                                echo "<script>alert('Vous n\'est pas de cette classe (".$classe[1].")');</script>";
                                echo "<script>document.location.replace('index-".$lang.".php?lang=".$lang."&city=".$city."&');</script>";
                            }
                            else {
                                echo "<script>document.location.replace('resulats-session-1-2018-2019-".$lang.".php?lang=".$lang."&city=".$city."&eleve=".$eleve[0]."&classe=".$classeId."&fq=".$frequenter[0]."');</script>";
                            }
                        }
                    }
                ?>
                <form class="ui form" method="post" action="" id="classe-form">
                    <h4 class="ui dividing header">Veuillez saisir votre matricule. Exemple: ISI-07859A-18</h4>
                    <div class="field">
                        <label for="matricule">Votre matricule</label>
                        <input type="text" name="matricule" id="matricule" required>
                    </div>
                    <br><br>
                    <div class="field">
                        <button class="negative ui button" name="sms"><i class="send icon"></i> Voir le résultat</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
