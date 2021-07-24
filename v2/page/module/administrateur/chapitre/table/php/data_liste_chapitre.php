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

    if ($job == 'get_liste_chapitre' || $job == 'add_chapitre' || $job == 'edit_chapitre' || $job == 'del_chapitre') {

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
    if ($job == 'get_liste_chapitre') {

        $PDO_query_chapitre = Bdd::connectBdd()->prepare("SELECT * FROM methode_chapitre ORDER BY methode_chapitre_id ASC");
        $PDO_query_chapitre->execute();

        while ($chapitre = $PDO_query_chapitre->fetch()) {

            $functions = '
            <a href="modif_chapitre.php?id='.$chapitre['methode_chapitre_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a href="#" id="delete-record" data-id="' .$chapitre['methode_chapitre_id'].'" data-name="' .$chapitre['methode_chapitre_nom'].'" class="btn btn-danger btn-sm">Supprimer</a>            
            ';

            $query = Bdd::connectBdd()->prepare("SELECT * FROM methode_socle WHERE methode_socle_id = :methode_socle_id");
            $query->bindParam(":methode_socle_id", $chapitre['methode_socle_id'], PDO::PARAM_INT);
            $query->execute();	
            $query_socle = $query->fetch();
            $query->closeCursor();


            $date = date_create($chapitre['methode_chapitre_date']);
            $date_create = date_format($date, "d/m/Y");

            $name_user = Membre::info($chapitre['methode_chapitre_user'], 'nom').' '.Membre::info($chapitre['methode_chapitre_user'], 'prenom');

            $chapitre_bread = $chapitre['methode_chapitre_nom'];
            $socle = $query_socle['methode_socle_nom'];

            $chemin = '<b>'.$socle.'</b> > '.$chapitre_bread;


            $id_chapitre = $chapitre['methode_chapitre_id'];       


            switch($chapitre['methode_chapitre_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Actif</div>';
                break;                          
                default:
                    $statut = '<div class="badge badge-light-danger">Inactif</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id_chapitre,
                "full_name" => $name_user,
                "chapitre" => $chapitre_bread,                
                "post" => $chemin,
                "start_date" => $date_create,
                "statut" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_chapitre->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        $PDO_query_chapitre = null;


    } elseif ($job == 'add_chapitre') {

        try {

            $query = Bdd::connectBdd()->prepare("INSERT INTO methode_chapitre (`methode_chapitre_nom`, `methode_socle_id`, `methode_chapitre_date`, `methode_chapitre_statut`, `methode_chapitre_user`)
			 VALUES (:methode_chapitre_nom, :methode_socle_id, now(), :methode_chapitre_statut, :methode_chapitre_user)");

            $query->bindParam(":methode_chapitre_nom", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":methode_socle_id", $_POST['socle'], PDO::PARAM_INT);
            $query->bindParam(":methode_chapitre_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":methode_chapitre_user", $_POST['user'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Chapitre ajouté avec succés';
            
        }catch (PDOException $x) {

            die("Secured");

            $result = 'error';
            $message = 'Échec de requête';
        }
        $query = null;
        
    } elseif ($job == 'del_chapitre') {
        
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM `methode_chapitre` WHERE methode_chapitre_id = :methode_chapitre_id");
                $query_select_del->bindParam(":methode_chapitre_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête';
           
        
    } elseif ($job == 'edit_chapitre') {
        

            $query = Bdd::connectBdd()->prepare("UPDATE methode_chapitre SET methode_chapitre_nom = :methode_chapitre_nom, methode_socle_id = :methode_socle_id, methode_chapitre_date = NOW(), methode_chapitre_statut = :methode_chapitre_statut, methode_chapitre_user = :methode_chapitre_user  WHERE methode_chapitre_id = :methode_chapitre_id");

            $query->bindParam(":methode_chapitre_id", $_POST['id_chapitre'], PDO::PARAM_INT);
            $query->bindParam(":methode_chapitre_nom", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":methode_socle_id", $_POST['socle'], PDO::PARAM_INT);
            $query->bindParam(":methode_chapitre_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":methode_chapitre_user", $_POST['user'], PDO::PARAM_INT);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Chapitre modifié avec succés';
        
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
