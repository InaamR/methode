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

        $PDO_query_sous_chapitre = Bdd::connectBdd()->prepare("SELECT * FROM methode_sous_chapitre ORDER BY methode_sous_chapitre_id DESC");
        $PDO_query_sous_chapitre->execute();

        while ($sous_chapitre = $PDO_query_sous_chapitre->fetch()) {

            $functions = '
            <a href="modif_sous_chapitre.php?id='.$sous_chapitre['methode_sous_chapitre_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a id="delete-record" data-id="' .$sous_chapitre['methode_sous_chapitre_id'].'" data-name="' .$sous_chapitre['methode_sous_chapitre_nom'].'" class="btn btn-danger btn-sm">Supprimer</a>
            ';

            $query = Bdd::connectBdd()->prepare("SELECT * FROM methode_chapitre WHERE methode_chapitre_id = :methode_chapitre_id");
            $query->bindParam(":methode_chapitre_id", $sous_chapitre['methode_chapitre_id'], PDO::PARAM_INT);
            $query->execute();	
            $query_chapitre = $query->fetch();
            $query->closeCursor();


            $date = date_create($sous_chapitre['methode_sous_chapitre_date']);
            $date_create = date_format($date, "d/m/Y");

            $name_user = Membre::info($sous_chapitre['methode_sous_chapitre_user'], 'nom').' '.Membre::info($sous_chapitre['methode_sous_chapitre_user'], 'prenom');

            $sous_chapitre_bread = $sous_chapitre['methode_sous_chapitre_nom'];
            $chapitre_nom = $query_chapitre['methode_chapitre_nom'];

            $chemin = '<b>'.$chapitre_nom.'</b> > '.$sous_chapitre_bread;


            $id_sous_chapitre = $sous_chapitre['methode_sous_chapitre_id']; 


            switch($sous_chapitre['methode_sous_chapitre_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Actif</div>';
                break;                         
                default:
                    $statut = '<div class="badge badge-light-danger">Inactif</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id,
                "full_name" => $name_user,
                "sous_chapitre" => $sous_chapitre_bread,                
                "post" => $chemin,
                "start_date" => date_format($date, "d/m/Y"),
                "status" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_sous_chapitre->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';

        $bdd = null;
        $PDO_query_sous_chapitre = null;


    } elseif ($job == 'add_sous_chapitre') {

        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO methode_sous_chapitre (`methode_sous_chapitre_date`, `methode_sous_chapitre_nom`, `methode_chapitre_id`, `methode_sous_chapitre_statut`, `methode_sous_chapitre_user`)
			 VALUES (now(), :methode_sous_chapitre_nom, :methode_chapitre_id, :methode_sous_chapitre_statut, :methode_sous_chapitre_user)");

            $query->bindParam(":methode_sous_chapitre_nom", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":methode_chapitre_id", $_POST['chapitre'], PDO::PARAM_STR);
            $query->bindParam(":methode_sous_chapitre_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":methode_sous_chapitre_user", $_POST['user'], PDO::PARAM_INT);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Sous chapitre ajouté avec succés';
            
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
