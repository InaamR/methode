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

            $query = Bdd::connectBdd()->prepare("SELECT * FROM planning_prod WHERE planning_prod_id = :planning_prod_id");
            $query->bindParam(":planning_prod_id", $avancement['planning_prod_id'], PDO::PARAM_INT);
            $query->execute();	
            $query_etude = $query->fetch();
            $query->closeCursor();

            $query = Bdd::connectBdd()->prepare("SELECT * FROM ident_vehicule WHERE ident_vehicule_CODGRPVER = :ident_vehicule_CODGRPVER");
            $query->bindParam(":ident_vehicule_CODGRPVER", $query_etude['planning_prod_Code_GMOD_P'], PDO::PARAM_INT);
            $query->execute();	
            $query_idv = $query->fetch();
            $query->closeCursor();


            $date_insertion = date_create($avancement['avancement_technicien_date']);
            $date_debut = date_create($avancement['avancement_technicien_date_debut']);
            $date_fin = date_create($avancement['avancement_technicien_date_fin']);
            $name_technicien = Membre::info($avancement['technicien_id'], 'nom').' '.Membre::info($avancement['technicien_id'], 'prenom');
            $etude_nom = $query_idv['ident_vehicule_MARQUE'].' '.$query_idv['ident_vehicule_GMOD_P'].' ('.$query_idv['ident_vehicule_CODGRPVER'].')'; 
            $id = $avancement['avancement_technicien_id'];
            $socle = $query_socle['methode_socle_nom'];
            $estim_moy = $avancement['avancement_technicien_estimation_moyenne_jrs'];
            $estim_charge = $avancement['avancement_technicien_estimation_charge'];
            $nbr_j_reels = $avancement['avancement_technicien_nbre_jours_reels'];

            $functions = '
            <a href="modif_avancement.php?id='.$avancement['avancement_technicien_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a id="delete-record" data-id="'.$avancement['avancement_technicien_id'].'" data-name="'.$etude_nom.'" class="btn btn-danger btn-sm">Supprimer</a>
            ';
            $date1 = new DateTime($avancement['avancement_technicien_date_debut']);
            $date2 = new DateTime($avancement['avancement_technicien_date_fin']);
            $nbr_jours_reels =  $date2->diff($date1)->format("%a");

            // switch($avancement['avancement_technicien_statut'])
            // {
            //     case '1':
            //         $statut = '<div class="badge badge-light-success">Active</div>';
            //     break;                         
            //     default:
            //         $statut = '<div class="badge badge-light-danger">Inactive</div>';
            // }
            
            $date_debut_format = date_format($date_debut, "d/m/Y");

            $datejour = date('d/m/Y');
            //la date du fin est stocké dans une base de données
                   //on extracte la date du fin depuis la bdd et on la met dans une variable $datefin
            $datedebut= $date_debut_format;
            
                   //explode pour mettre la date du fin en format numerique: 12/05/2006  -> 12052006
            $ddebut = explode("/", $datedebut); 
            
                   //explode pour mettre la date du jour en format numerique: 31/05/2009  -> 31052009
                   $djour = explode("/", $datejour); 
           
                   // concaténation pour inverser l'ordre: 12052006 -> 20060512
            $debut_etude = $ddebut[2].$ddebut[1].$ddebut[0]; 
                   // concaténation pour inverser l'ordre: 31052009 -> 20090531
            $auj = $djour[2].$djour[1].$djour[0]; 


/////////////////////////////////////////////////////////////////////////////


            $date_fin_format = date_format($date_fin, "d/m/Y");

            //la date du fin est stocké dans une base de données
                   //on extracte la date du fin depuis la bdd et on la met dans une variable $datefin
            $datefin= $date_fin_format;
            
                   //explode pour mettre la date du fin en format numerique: 12/05/2006  -> 12052006
            $dfin = explode("/", $datefin); 
                       
                   // concaténation pour inverser l'ordre: 12052006 -> 20060512
            $fin_etude = $dfin[2].$dfin[1].$dfin[0]; 
                   // concaténation pour inverser l'ordre: 31052009 -> 20090531
            
            // Ensuite il suffit de comparer les deux valeurs
            
            if ($auj<$debut_etude)
            {
                $statut = '<div class="badge badge-light-warning">En attente</div>';
            }
            elseif($auj>=$debut_etude && $auj<=$fin_etude)
            {
                $statut = '<div class="badge badge-light-info">En cours</div>';
            }
            elseif($auj>$fin_etude)
            {
                $statut = '<div class="badge badge-light-danger">A vérifier</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id,
                "full_name" => $name_technicien,
                "etude" => $etude_nom,
                "socle" => $socle,
                "estim_moy" => $estim_moy,
                "estim_charge" => $estim_charge,
                "date_debut" => date_format($date_debut, "d/m/Y"),
                "date_fin" => date_format($date_fin, "d/m/Y"),
                "nbr_j_reels" => $nbr_jours_reels,
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


    } elseif ($job == 'add_avancement') {

        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO avancement_technicien (`avancement_technicien_date`, `technicien_id`, `planning_prod_id`, `methode_socle_id`, `avancement_technicien_estimation_charge`, `avancement_technicien_date_debut`, `avancement_technicien_date_fin`)
			 VALUES (now(), :technicien_id, :planning_prod_id, :methode_socle_id, :avancement_technicien_estimation_charge, :avancement_technicien_date_debut, :avancement_technicien_date_fin)");

            $query->bindParam(":technicien_id", $_POST['technicien'], PDO::PARAM_INT);
            $query->bindParam(":planning_prod_id", $_POST['etude'], PDO::PARAM_INT);
            $query->bindParam(":methode_socle_id", $_POST['socle'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_estimation_charge", $_POST['estimation_charge'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_date_debut", $_POST['date_debut'], PDO::PARAM_STR);
            $query->bindParam(":avancement_technicien_date_fin", $_POST['date_fin'], PDO::PARAM_STR);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Affectation ajoutée avec succés';
            
        } catch (PDOException $x) {
            die("Secured");
            $result = 'error';
            $message = 'Échec de requête';
        }
        $query = null;

    } elseif ($job == 'del_avancement') {
        
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM avancement_technicien WHERE avancement_technicien_id = :avancement_technicien_id");
                $query_select_del->bindParam(":avancement_technicien_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête';
           
        
    } elseif ($job == 'edit_avancement') {
        
            $query = Bdd::connectBdd()->prepare("UPDATE avancement_technicien SET technicien_id = :technicien_id, planning_prod_id = :planning_prod_id, methode_socle_id = :methode_socle_id, avancement_technicien_estimation_charge = :avancement_technicien_estimation_charge, 	avancement_technicien_date_debut = :avancement_technicien_date_debut, avancement_technicien_date_fin = :avancement_technicien_date_fin WHERE avancement_technicien_id = :avancement_technicien_id");

            $query->bindParam(":technicien_id", $_POST['technicien'], PDO::PARAM_INT);
            $query->bindParam(":planning_prod_id", $_POST['etude'], PDO::PARAM_INT);
            $query->bindParam(":methode_socle_id", $_POST['socle'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_estimation_charge", $_POST['estimation_charge'], PDO::PARAM_INT);
            $query->bindParam(":avancement_technicien_date_debut", $_POST['date_debut'], PDO::PARAM_STR);
            $query->bindParam(":avancement_technicien_date_fin", $_POST['date_fin'], PDO::PARAM_STR);
            $query->bindParam(":avancement_technicien_id", $_POST['id_avancement'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Affectation modifiée avec succés';
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
