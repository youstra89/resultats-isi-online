<?php
    require('connexion.inc.php');
    $lang = empty($_GET['lang']) ? 'fr' : $_GET['lang'];
    $city = $_GET['city'];
    if($city != 0 && $city != 1)
    echo "<script>document.location.replace('index-".$lang.".php');</script>";
    $fq       = $_GET['fq'];
    $eleveId  = $_GET['eleve'];
    $classeId = $_GET['classe'];
    if(empty($fq) || empty($eleveId) || empty($classeId))
    {
        echo "<script>alert('Vous n\'avez pas saisies toutes les informations demandées.".$fq." ".$eleveId." ".$classeId."');</script>";
        echo "<script>document.location.replace('index-".$lang.".php');</script>";
    }
    elseif(!is_numeric($fq) || !is_numeric($eleveId) || !is_numeric($classeId))
    {
        echo "<script>alert('Les données saisies sont erronées!');</script>";
        echo "<script>document.location.replace('index-".$lang.".php');</script>";
    }
    else {
        $sql = "SELECT id, annee_scolaire_id, eleve_id, classe_id, redouble FROM frequenter WHERE id = :id AND eleve_id = :eleve AND classe_id = :classe AND annee_scolaire_id = :annee";
        $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute([':id' => $fq, ':eleve' => $eleveId, ':classe' => $classeId, ':annee' => 2]);
        $frequenter = $sth->fetch();

        if(empty($frequenter))
        {
            echo "<script>alert('Veuillez suivre la procédure normale et saisir toutes les informations demandées.');</script>";
            echo "<script>document.location.replace('index-".$lang.".php');</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>نتائج الامتحان بالمركز الفترة الأولى 2018-2019</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    </head>
    <body>
      <div class="ui attached large stackable menu">
        <div class="ui container">
          <a class="item" href="index-<?php echo $lang; ?>.php">
            <i class="home icon"></i> الاستقبال
          </a>
          <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=0">
            <i class="grid layout icon"></i> أبيدجان
          </a>
          <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=1">
            <i class="grid layout icon"></i> أغبوفيل
          </a>

          <div class="right item">
            <div class="ui simple dropdown item">
            تغيير اللغة
              <i class="dropdown icon"></i>
              <div class="menu">
                <a class="item" href="resulats-session-1-2018-2019-fr.php?lang=fr&city=<?php echo $city; ?>&eleve=<?php echo $eleveId; ?>&classe=<?php echo $classeId; ?>&fq=<?php echo $fq; ?>"><i class="globe icon"></i> Français</a>
                <a class="item" href="resulats-session-1-2018-2019-ar.php?lang=ar&city=<?php echo $city; ?>&eleve=<?php echo $eleveId; ?>&classe=<?php echo $classeId; ?>&fq=<?php echo $fq; ?>"><i class="globe icon"></i> العربية</a>
              </div>
            </div>
          </div>
        </div>
      </div>

        <br>
        <?php
            $sql = "SELECT eleve_id, matricule, date_naissance, nom_ar, pnom_ar, nom_fr, pnom_fr, commune, residence, renvoye FROM eleve WHERE eleve_id = :eleve";
            $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([':eleve' => $eleveId]);
            $eleve = $sth->fetch();
        ?>
        <div class="ui container" style="position: relative; z-index: 0;">

            <div class="ui raised very padded text segment">
                <center>
                  <h2 class="ui center header" style="font-size: 4rem; color: teal">
                    مركز العلوم الإسلامية <br>
                    <?php echo $city == 0 ? 'أبيدجان' : 'أغبوفيل'; ?>
                  </h2>
                </center>
            </div>
            <div class="ui raised very padded text segment">
                <h2 class="ui center header">النتيجة</h2>
                <br>
                <?php
                    echo "<div class=\"ui olive segment\"><h3>Matricule :</h3><span class=\"info-eleve\">".$eleve[1]."</span></div>";
                    echo "<div class=\"ui olive segment\"><h3>الاسم و اللقب :</h3><span class=\"info-eleve\">".$eleve[4]." ".$eleve[3]."</span></div>";
                    echo "<div class=\"ui green segment\"><h3>Nom & Prénom: </h3><span class=\"info-eleve\">".$eleve[5]." ".$eleve[6]."</span></div>";
                    echo "<div class=\"ui teal segment\"><h3>Date de naissance: </h3><span class=\"info-eleve\">".$eleve[2]."</span></div>";
                    echo "<div class=\"ui blue segment\"><h3>Résidence: </h3><span class=\"info-eleve\">".$eleve[7]." ".$eleve[8]."</span></div>";

                    //On va sélectionner les matières qui sont enseignées dans cette classe (sous entendu le niveau de cette classe)
                    $sql = "SELECT m.matiere_id, m.libelle_matiere FROM matiere m JOIN enseignement e ON m.matiere_id = e.matiere_id JOIN niveau n ON e.niveau_id = n.id JOIN classe c ON n.id = c.niveau_id WHERE c.classe_id = :classe AND e.annee_scolaire_id = 2";
                    $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute([':classe' => $classeId]);
                    $matieres = $sth->fetchAll();

                    //On sélectionne ensuite les notes de l'élève
                    $sql = "SELECT n.eleve_id, n.matiere_id, m.libelle_matiere, n.examen_id, n.note, n.participation, n.appreciation_fr, n.appreciation_ar FROM note n JOIN eleve e ON n.eleve_id = e.eleve_id JOIN matiere m ON m.matiere_id = n.matiere_id JOIN examen ex ON n.examen_id = ex.examen_id WHERE e.eleve_id = :eleve AND ex.examen_id = 3";
                    $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute([':eleve' => $eleveId]);
                    $notes = $sth->fetchAll();

                    //Et enfin, on sélectionne la moyenne de l'élève
                    $sql = "SELECT m.id, m.eleve, m.examen, m.total_points, m.moyenne, m.rang FROM moyenne m WHERE eleve = :eleve AND examen = 3";
                    $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $sth->execute([':eleve' => $eleveId]);
                    $moyenne = $sth->fetch();
                ?>
                <table class="ui celled striped table">
                    <thead>
                        <tr>
                            <th>مادة</th>
                            <th>الدرجة</th>
                            <th>التقدير</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($matieres as $keyM => $valueM) {
                                foreach ($notes as $keyN => $valueN) {
                                    if($matieres[$keyM][0] == $notes[$keyN][1] && $notes[$keyN][0] == $eleveId){
                                        echo "<tr>";
                                            echo "<td class=\"collapsing\">".$notes[$keyN][2]."</td>";
                                            echo "<td class=\"collapsing\">".$notes[$keyN][4]."</td>";
                                            echo "<td class=\"right aligned collapsing\">".$notes[$keyN][7]."</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <br><br>
                <table class="ui very basic table">
                    <thead>
                        <tr>
                            <th colspan="3" style="font-size: 3rem">المعدل والترتيب</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo "<tr style=\"font-size: 2rem\">";
                            echo "<td class=\"collapsing\">Total des points: <a class=\"ui teal tag massive label\">".$moyenne[3]."</a></td>";
                            echo "<td class=\"collapsing\">Moyenne: <a class=\"ui olive tag massive label\">".$moyenne[4]."</a></td>";
                            echo "<td class=\"right aligned collapsing\">Rang: <a class=\"ui red tag massive label\">".$moyenne[5]."<sup>eme</sup></a></td>";
                        echo "</tr>";
                        ?>
                    </tbody>
                </table>
                <br><br><br>
                <center>
                    <a href="" class="ui massive teal button"><i class="print icon"></i> طباعة كشف الدرجات</a>
                </center>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
