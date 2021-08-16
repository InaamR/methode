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

    if ($job == 'get_liste_socle' || $job == 'add_socle' || $job == 'edit_socle' || $job == 'del_socle') {

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
    if ($job == 'get_liste_socle') {

        $PDO_query_socle = Bdd::connectBdd()->prepare("SELECT * FROM methode_socle ORDER BY methode_socle_id ASC");
        $PDO_query_socle->execute();

        while ($socle = $PDO_query_socle->fetch()) {

            $functions = '
            <a href="modif_socle.php?id='.$socle['methode_socle_id'].'" style="font-size:25px"><i class="bi bi-pencil-square"></i></a>
            <a href="#" id="delete-record" data-id="' .$socle['methode_socle_id'].'" data-name="' .$socle['methode_socle_nom'].'" style="font-size:25px"><i class="bi bi-trash"></i></a>            
            ';


            $date = date_create($socle['methode_socle_date']);
            $date_create = date_format($date, "d/m/Y");

            $name_user = Membre::info($socle['methode_socle_user'], 'nom').' '.Membre::info($socle['methode_socle_user'], 'prenom');

            $id_socle = $socle['methode_socle_id'];  
            $socle_nom = $socle['methode_socle_nom'];      


            switch($socle['methode_socle_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Actif</div>';
                break;                          
                default:
                    $statut = '<div class="badge badge-light-danger">Non-actif</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id_socle,
                "full_name" => $name_user,
                "socle" => $socle_nom,                
                "start_date" => $date_create,
                "statut" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_socle->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        $PDO_query_socle = null;


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
