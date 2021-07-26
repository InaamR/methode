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

    if ($job == 'get_liste_planning' || $job == 'add_socle' || $job == 'edit_socle' || $job == 'del_socle') {

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
    if ($job == 'get_liste_planning') {

        $PDO_query_etude = Bdd::connectBdd()->prepare("SELECT * FROM planning_prod ORDER BY planning_prod_id ASC");
        $PDO_query_etude->execute();

        while ($etude = $PDO_query_etude->fetch()) {

            $query = Bdd::connectBdd()->prepare("SELECT * FROM ident_vehicule WHERE ident_vehicule_CODGRPVER = :ident_vehicule_CODGRPVER");
            $query->bindParam(":ident_vehicule_CODGRPVER", $etude['planning_prod_Code_GMOD_P'], PDO::PARAM_INT);
            $query->execute();	
            $query_idv = $query->fetch();
            $query->closeCursor();


            $functions = '
            <a href="modif_planning.php?id='.$etude['planning_prod_id'].'" style="font-size: 0.9rem !important;" class="btn btn-info btn-sm waves-effect waves-float waves-light mr-25 mb-25"><i class="bi bi-pen"></i></a>                    
            ';

            $PDO_query_verif_avancement = Bdd::connectBdd()->prepare("SELECT * FROM avancement_technicien WHERE planning_prod_id  = :planning_prod_id");
            $PDO_query_verif_avancement->bindParam(":planning_prod_id", $etude['planning_prod_id'], PDO::PARAM_INT);
            $PDO_query_verif_avancement->execute();
            $avancement_existe = $PDO_query_verif_avancement->rowCount();
            $PDO_query_verif_avancement->closeCursor();

            if($avancement_existe == 0){

                $functions .= '
                            <a href="#" id="delete-record" data-id="' .$etude['planning_prod_id'].'" data-name="' .$query_idv['ident_vehicule_MARQUE'].' '.$query_idv['ident_vehicule_GMOD_P'].'" style="font-size: 0.9rem !important;" class="btn btn-danger btn-sm waves-effect waves-float waves-light pr-1 mb-25"><i class="bi bi-trash"></i></a>           
                            ';

            }else{

                $functions .= '
                            <a style="font-size: 0.9rem !important;" class="btn btn-secondary btn-sm waves-effect waves-float waves-light mb-25"><i class="bi bi-trash"></i></a>          
                            ';

            }

            $date_insertion = date_create($etude['planning_prod_date']);
            $date_insertion_create = date_format($date_insertion, "d/m/Y");

            $name_user = Membre::info($etude['planning_prod_user'], 'nom').' '.Membre::info($etude['planning_prod_user'], 'prenom');

            $date_livrable = date_create($etude['planning_prod_Livrable']);
            $date_livrable_create = date_format($date_livrable, "d/m/Y");

            setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
            $livrable = strftime("%B %Y", strtotime($date_livrable_create));           

            $etude_id = $etude['planning_prod_id'];  
            $etude_nom = $query_idv['ident_vehicule_MARQUE'].' '.$query_idv['ident_vehicule_GMOD_P']; 

            $Code_GMOD_P = $etude['planning_prod_Code_GMOD_P']; 
            $MARQUE = $query_idv['ident_vehicule_MARQUE'];
            $GMOD_P = $query_idv['ident_vehicule_GMOD_P'];

            $ident = $etude['planning_prod_var_ident'];
            $se = $etude['planning_prod_var_se'];



            switch($etude['planning_prod_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-info">En cours</div>';
                break;
                case '4':
                    $statut = '<div class="badge badge-light-dark">Terminée</div>';
                break;                          
                default:
                    $statut = '<div class="badge badge-light-danger">Inactif</div>';
            }


            switch($etude['planning_prod_prestation_md'])
            {
                case '1':
                    $md = '<div class="badge badge-light-success">CREA</div>';
                break;
                case '2':
                    $md = '<div class="badge badge-light-info">UPGR</div>';
                break;                          
                case '3':
                    $md = '<div class="badge badge-light-warning">NL</div>';
                break; 
                default:
                    $md = '<div class="badge badge-light-danger">A verifier</div>';
            }


            switch($etude['planning_prod_prestation_pe'])
            {
                case '1':
                    $pe = '<div class="badge badge-light-success">CREA_PE</div>';
                break;
                case '2':
                    $pe = '<div class="badge badge-light-info">MAJ_PE</div>';
                break;                          
                case '3':
                    $pe = '<div class="badge badge-light-warning">NL</div>';
                break; 
                case '4':
                    $pe = '<div class="badge badge-light-success">OK</div>';
                break; 
                default:
                    $pe = '<div class="badge badge-light-danger">A verifier</div>';
            }


            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $etude_id,
                "full_name" => $name_user,
                "livrable" => $livrable,
                "Code_GMOD_P" => $Code_GMOD_P,  
                "MARQUE" => $MARQUE, 
                "GMOD_P" => $GMOD_P, 
                "md" => $md, 
                "pe" => $pe, 
                "ident" => $ident, 
                "se" => $se,
                "start_date" => $date_insertion_create,
                "statut" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_etude->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        $PDO_query_etude = null;


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
