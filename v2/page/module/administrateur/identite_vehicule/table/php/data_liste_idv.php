<?php

session_start();

$page = "";
if (empty($page)) {
    $page = "function";
    // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
    // On supprime également d'éventuels espaces
    $page = trim($page . ".php");
}

// On évite les caractères qui permettent de naviguer dans les répertoires
$page = str_replace("../", "protect", $page);
$page = str_replace(";", "protect", $page);
$page = str_replace("%", "protect", $page);

// On interdit l'inclusion de dossiers protégés par htaccess
if (preg_match("/config/", $page)) {
    echo $page;
} else {
    // On vérifie que la page est bien sur le serveur
    if (file_exists("../../../../../../config/" . $page) && $page != 'index.php') {
        include "../../../../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}

/*page_protect();
if (!checkAdmin()) {
    die("Secured");
    exit();
}*/

$job = '';
$id = '';
$st = '';

if (isset($_GET['job'])) {
    $job = $_GET['job'];

    if ($job == 'get_liste_idv' || $job == 'add_socle' || $job == 'edit_socle' || $job == 'del_socle') {

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (!is_numeric($id)) {
                $id = '';
            }
        }

    } else {
        $job = '';
    }

}

$mysql_data = [];

if ($job != '') {
    if ($job == 'get_liste_idv') {

        $PDO_query_identite_vehicule = Bdd::connectBdd()->prepare("SELECT * FROM ident_vehicule ORDER BY ident_vehicule_id ASC");
        $PDO_query_identite_vehicule->execute();

        while ($identite_vehicule = $PDO_query_identite_vehicule->fetch()) {

            $functions = '
            <a href="modif_socle.php?id='.$identite_vehicule['ident_vehicule_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a href="#" id="delete-record" data-id="' .$identite_vehicule['ident_vehicule_id'].'" data-name="' .$identite_vehicule['ident_vehicule_CODGRPVER'].'" class="btn btn-danger btn-sm">Supprimer</a>            
            ';


            $date = date_create($identite_vehicule['ident_vehicule_date']);
            $date_create = date_format($date, "d/m/Y");
            $name_user = Membre::info($identite_vehicule['ident_vehicule_user'], 'nom').' '.Membre::info($identite_vehicule['ident_vehicule_user'], 'prenom');


            $id_idv = $identite_vehicule['ident_vehicule_id'];  



            switch($identite_vehicule['ident_vehicule_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Actif</div>';
                break;                          
                default:
                    $statut = '<div class="badge badge-light-danger">Inactif</div>';
            }


            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id_idv,
                "full_name" => $name_user,



                "CGMOD_P" => $identite_vehicule['ident_vehicule_CGMOD_P'],
                "CODGRPVER" => $identite_vehicule['ident_vehicule_CODGRPVER'],
                "MARQUE" => $identite_vehicule['ident_vehicule_MARQUE'],
                "GAMME" => $identite_vehicule['ident_vehicule_GAMME'],
                "CODGRPMOD" => $identite_vehicule['ident_vehicule_CODGRPMOD'],
                "DATDEB_GRPMOD" => $identite_vehicule['ident_vehicule_DATDEB_GRPMOD'],
                "DATFIN_GRPMOD" => $identite_vehicule['ident_vehicule_DATFIN_GRPMOD'],
                "GMOD_P" => $identite_vehicule['ident_vehicule_GMOD_P'],

                "DATE_DEB_GMOD_P" => $identite_vehicule['ident_vehicule_DATE_DEB_GMOD_P'],
                "DATE_FIN_GMOD_P" => $identite_vehicule['ident_vehicule_DATE_FIN_GMOD_P'],
                "COMPLEMENTGAMME" => $identite_vehicule['ident_vehicule_COMPLEMENTGAMME'],
                "NUMEROSERIE" => $identite_vehicule['ident_vehicule_NUMEROSERIE'],
                "PHASE" => $identite_vehicule['ident_vehicule_PHASE'],
                "MODELE" => $identite_vehicule['ident_vehicule_MODELE'],
                "VARIANTEDATEDEBUT" => $identite_vehicule['ident_vehicule_VARIANTEDATEDEBUT'],
                "VARIANTEDATEFIN" => $identite_vehicule['ident_vehicule_VARIANTEDATEFIN'],

                "VERSIONSPECIFIQUE" => $identite_vehicule['ident_vehicule_VERSIONSPECIFIQUE'],
                "NOMBREPORTES" => $identite_vehicule['ident_vehicule_NOMBREPORTES'],
                "CFGPTE" => $identite_vehicule['ident_vehicule_CFGPTE'],
                "FORMECARROSSERIE" => $identite_vehicule['ident_vehicule_FORMECARROSSERIE'],
                "GENREVEHICULE" => $identite_vehicule['ident_vehicule_GENREVEHICULE'],
                "CARROSSERIECOMMERCIALE" => $identite_vehicule['ident_vehicule_CARROSSERIECOMMERCIALE'],
                "TYPEEMPATTEMENT" => $identite_vehicule['ident_vehicule_TYPEEMPATTEMENT'],
                "HAUTEUR" => $identite_vehicule['ident_vehicule_HAUTEUR'],


                "CHARGE" => $identite_vehicule['ident_vehicule_CHARGE'],
                "TYPEMOTEUR" => $identite_vehicule['ident_vehicule_TYPEMOTEUR'],
                "INDICEMOTEUR" => $identite_vehicule['ident_vehicule_INDICEMOTEUR'],
                "CYLINDREELITRES" => $identite_vehicule['ident_vehicule_CYLINDREELITRES'],
                "CYLINDREECC" => $identite_vehicule['ident_vehicule_CYLINDREECC'],
                "ENERGIE" => $identite_vehicule['ident_vehicule_ENERGIE'],
                "INJECTIONCOMMERCIALE" => $identite_vehicule['ident_vehicule_INJECTIONCOMMERCIALE'],
                "SURALIMENTATION" => $identite_vehicule['ident_vehicule_SURALIMENTATION'],

                "FILTREAPARTICULES" => $identite_vehicule['ident_vehicule_FILTREAPARTICULES'],
                "AVECCATALYSEUR" => $identite_vehicule['ident_vehicule_AVECCATALYSEUR'],
                "DEPOLLUTION" => $identite_vehicule['ident_vehicule_DEPOLLUTION'],
                "CONFIGURATIONMOTEUR" => $identite_vehicule['ident_vehicule_CONFIGURATIONMOTEUR'],
                "NOMBRECYLINDRES" => $identite_vehicule['ident_vehicule_NOMBRECYLINDRES'],
                "NOMBRESOUPAPES" => $identite_vehicule['ident_vehicule_NOMBRESOUPAPES'],
                "ARBREACAME" => $identite_vehicule['ident_vehicule_ARBREACAME'],
                "PUISSANCE" => $identite_vehicule['ident_vehicule_PUISSANCE'],

                "PUISSANCEFISCALE" => $identite_vehicule['ident_vehicule_PUISSANCEFISCALE'],
                "TYPEDISTRIBUTION" => $identite_vehicule['ident_vehicule_TYPEDISTRIBUTION'],
                "ENTRAINEMENTDISTRIBUTION" => $identite_vehicule['ident_vehicule_ENTRAINEMENTDISTRIBUTION'],
                "CONSTMOT" => $identite_vehicule['ident_vehicule_CONSTMOT'],
                "MOTEURCOMMERCIAL" => $identite_vehicule['ident_vehicule_MOTEURCOMMERCIAL'],
                "GENREBOITE" => $identite_vehicule['ident_vehicule_GENREBOITE'],
                "NOMBRERAPPORTS" => $identite_vehicule['ident_vehicule_NOMBRERAPPORTS'],
                "TYPEBOITE" => $identite_vehicule['ident_vehicule_TYPEBOITE'],

                "ESSIEUMOTEUR" => $identite_vehicule['ident_vehicule_ESSIEUMOTEUR'],
                "TYPEFREINAVANT" => $identite_vehicule['ident_vehicule_TYPEFREINAVANT'],
                "TYPEFREINARRIERE" => $identite_vehicule['ident_vehicule_TYPEFREINARRIERE'],
                "TONNAGE" => $identite_vehicule['ident_vehicule_TONNAGE'],
                "TYPSUSP" => $identite_vehicule['ident_vehicule_TYPSUSP'],
                "COTECONDUCTEUR" => $identite_vehicule['ident_vehicule_COTECONDUCTEUR'],
                "TYPEMINES" => $identite_vehicule['ident_vehicule_TYPEMINES'],
                "TAPV" => $identite_vehicule['ident_vehicule_TAPV'],
                
                

                "start_date" => $date_create,
                "statut" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_identite_vehicule->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        $PDO_query_identite_vehicule = null;


    } elseif ($job == 'add_socle') {

        try {

            $query = Bdd::connectBdd()->prepare("INSERT INTO methode_socle (`methode_socle_nom`, `methode_socle_date`, `methode_socle_statut`, `methode_socle_user`)
			 VALUES (:methode_socle_nom, now(), :methode_socle_statut, :methode_socle_user)");

            $query->bindParam(":methode_socle_nom", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":methode_socle_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":methode_socle_user", $_POST['user'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Socle ajouté avec succés';
            
        }catch (PDOException $x) {

            die("Secured");

            $result = 'error';
            $message = 'Échec de requête';
        }
        $query = null;
        
    } elseif ($job == 'del_socle') {
        
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM `methode_socle` WHERE methode_socle_id = :methode_socle_id");
                $query_select_del->bindParam(":methode_socle_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête';
           
        
    } elseif ($job == 'edit_socle') {
        

            $query = Bdd::connectBdd()->prepare("UPDATE methode_socle SET methode_socle_nom = :methode_socle_nom, methode_socle_date = NOW(), methode_socle_statut = :methode_socle_statut, methode_socle_user = :methode_socle_user  WHERE methode_socle_id = :methode_socle_id");

            $query->bindParam(":methode_socle_id", $_POST['id_socle'], PDO::PARAM_INT);
            $query->bindParam(":methode_socle_nom", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":methode_socle_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":methode_socle_user", $_POST['user'], PDO::PARAM_INT);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Socle modifié avec succés';
        
    }
}

$data = [
    "result" => $result,
    "message" => $message,
    "data" => $mysql_data,
];

$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
print $json_data;
?>
