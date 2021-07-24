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

    if ($job == 'get_liste_sous_chapitre' || $job == 'add_sous_chapitre' || $job == 'edit_sous_chapitre' || $job == 'del_sous_chapitre') {

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
    if ($job == 'get_liste_sous_chapitre') {

        $PDO_query_sous_chapitre = Bdd::connectBdd()->prepare("SELECT * FROM methode_equipe ORDER BY equipe_name ASC");
        $PDO_query_equipe->execute();

        while ($sous_chapitre = $PDO_query_equipe->fetch()) {

            $functions = '
            <a href="modif_equipe.php?id='.$equipe['equipe_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a id="delete-record" data-id="' .$equipe['equipe_id'].'" data-name="' .$equipe['equipe_name'].'" class="btn btn-danger btn-sm">Supprimer</a>
            ';


            $date = date_create($equipe['equipe_date']);
            $name_user = Membre::info($_SESSION['id'], 'nom').' '.Membre::info($_SESSION['id'], 'prenom');
            $titre = $equipe['equipe_name'];
            $id = $equipe['equipe_id'];
            $abr_equipe = $equipe['equipe_abr'];


            switch($equipe['equipe_statut'])
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
                "full_name" => $name_user,
                "titre" => $titre,
                "abr_equipe" => $abr_equipe,
                "start_date" => date_format($date, "d/m/Y"),
                "status" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_equipe->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';

        $bdd = null;
        $PDO_query_equipe = null;


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
           
        
    } elseif ($job == 'edit_equipe') {
        
            $query = Bdd::connectBdd()->prepare("UPDATE methode_equipe SET equipe_name = :equipe_name, equipe_abr = :equipe_abr, equipe_date = NOW(), equipe_statut = :equipe_statut, equipe_user = :equipe_user  WHERE equipe_id = :equipe_id");

            $query->bindParam(":equipe_id", $_POST['id'], PDO::PARAM_INT);
            $query->bindParam(":equipe_name", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":equipe_abr", $_POST['abr'], PDO::PARAM_STR);
            $query->bindParam(":equipe_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":equipe_user", $_POST['user'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Succès de requête';
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
