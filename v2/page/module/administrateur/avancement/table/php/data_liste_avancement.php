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

if(empty($_SESSION['id'])){

    ProtectEspace::administrateur("", "", "");

}else{

    ProtectEspace::administrateur($_SESSION['id'], $_SESSION['jeton'], $_SESSION['niveau']);

}

$job = '';
$id = '';

if (isset($_GET['job'])) {
    $job = $_GET['job'];

    if ($job == 'get_liste_avancement' || $job == 'add_avancement' || $job == 'edit_avancement' || $job == 'del_avancement') {

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
    if ($job == 'get_liste_avancement') {

        $PDO_query_avancement = Bdd::connectBdd()->prepare("SELECT * FROM avancement_technicien ORDER BY avancement_technicien_id ASC");
        $PDO_query_avancement->execute();

        while ($avancement = $PDO_query_avancement->fetch()) {

            $query = Bdd::connectBdd()->prepare("SELECT * FROM methode_socle WHERE methode_socle_id = :methode_socle_id");
            $query->bindParam(":methode_socle_id", $avancement['methode_socle_id'], PDO::PARAM_INT);
            $query->execute();	
            $query_socle = $query->fetch();
            $query->closeCursor();

            $functions = '
            <a href="modif_avancement.php?id='.$avancement['avancement_technicien_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a id="delete-record" data-id="'.$avancement['avancement_technicien_id'].'" class="btn btn-danger btn-sm">Supprimer</a>
            ';


            $date_insertion = date_create($avancement['avancement_technicien_date']);
            $date_debut = date_create($avancement['avancement_technicien_date_debut']);
            $date_fin = date_create($avancement['avancement_technicien_date_fin']);
            $name_technicien = Membre::info($avancement['technicien_id'], 'nom').' '.Membre::info($avancement['technicien_id'], 'prenom');
            $etude = $avancement['planning_prod_id'];
            $id = $avancement['avancement_technicien_id'];
            $socle = $query_socle['methode_socle_nom'];
            $estim_moy = $avancement['avancement_technicien_estimation_moyenne_jrs'];
            $estim_charge = $avancement['avancement_technicien_estimation_charge'];
            $nbr_j_reels = $avancement['avancement_technicien_nbre_jours_reels'];


            switch($avancement['avancement_technicien_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Active</div>';
                break;                         
                default:
                    $statut = '<div class="badge badge-light-danger">Inactive</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id,
                "full_name" => $name_technicien,
                "etude" => $etude,
                "socle" => $socle,
                "estim_moy" => $estim_moy,
                "estim_charge" => $estim_charge,
                "date_debut" => date_format($date_debut, "d/m/Y"),
                "date_fin" => date_format($date_fin, "d/m/Y"),
                "nbr_j_reels" => $nbr_j_reels,
                "start_date" => date_format($date_insertion, "d/m/Y"),
                "status" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_avancement->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';

        $bdd = null;
        $PDO_query_avancement = null;


    } elseif ($job == 'add_equipe') {

        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO methode_equipe (`equipe_date`, `equipe_name`, `equipe_abr`, `equipe_statut`, `equipe_user`)
			 VALUES (now(), :equipe_name, :equipe_abr, :equipe_statut, :equipe_user)");

            $query->bindParam(":equipe_name", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":equipe_abr", $_POST['abr'], PDO::PARAM_STR);
            $query->bindParam(":equipe_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":equipe_user", $_POST['user'], PDO::PARAM_INT);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Niveau ajouté avec succés';
            
        } catch (PDOException $x) {
            die("Secured");
            $result = 'error';
            $message = 'Échec de requête';
        }
        $query = null;

    } elseif ($job == 'del_equipe') {
        
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM methode_equipe WHERE equipe_id = :equipe_id");
                $query_select_del->bindParam(":equipe_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête'.$id;
           
        
    } elseif ($job == 'edit_avancement') {
        
            $query = Bdd::connectBdd()->prepare("UPDATE avancement_technicien SET avancement_technicien_estimation_moyenne_jrs = :avancement_technicien_estimation_moyenne_jrs, avancement_technicien_date_fin = :avancement_technicien_date_fin, avancement_technicien_nbre_jours_reels = :avancement_technicien_nbre_jours_reels, avancement_technicien_date = NOW(), avancement_technicien_statut = :avancement_technicien_statut, WHERE avancement_technicien_id = :avancement_technicien_id");

            $query->bindParam(":avancement_technicien_id", $_POST['id'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_estimation_moyenne_jrs", $_POST['estim_moy'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_date_fin", $_POST['date_fin'], PDO::PARAM_STR);
            $query->bindParam(":avancement_technicien_nbre_jours_reels", $_POST['nbr_j_reels'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Etude modifiée avec succés';
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
