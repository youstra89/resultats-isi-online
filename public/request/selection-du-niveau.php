<?php
    require('../connexion.inc.php');

    $regime = (int)$_GET['regime'];

    //echo "CCCC";
    //echo var_dump($regime);

    //function getNiveau($regime)
    //{
        $sql = "SELECT id, libelle_fr, libelle_ar, groupe_formation_id FROM niveau WHERE groupe_formation_id = :id";
        $sth = $query->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute([':id' => $regime]);
        $niveaux_db = $sth->fetchAll();

        $niveaux = [];
        foreach ($niveaux_db as $key => $value) {
            $niveaux[$value[0]] = [
                'id'   => $value[0],
                'name' => $value[1] . " --- " . $value[2]
            ];
        }

        echo json_encode($niveaux);
        
        //return $niveaux;
    //}
    
?>