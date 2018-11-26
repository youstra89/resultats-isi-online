<?php
    require('../connexion.inc.php');

    $nvo = (int)$_GET['niveau'];

    $sql = "SELECT classe_id, libelle_classe_fr, libelle_classe_ar FROM classe WHERE niveau_id = :id AND annee_scolaire_id = :annee";
    $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute([':id' => $nvo, ':annee' => 2]);
    $classes_db = $sth->fetchAll();

    $classes = [];
    foreach ($classes_db as $key => $value) {
        $classes[$value[0]] = [
            'id'   => $value[0],
            'name' => $value[1] . " -> " . $value[2]
        ];
    }

    echo json_encode($classes);
    
?>