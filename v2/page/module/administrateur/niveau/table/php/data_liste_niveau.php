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

    if ($job == 'get_liste_niveau' || $job == 'add_niveau' || $job == 'edit_niveau' || $job == 'del_niveau') {

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
    if ($job == 'get_liste_niveau') {

        $PDO_query_niveau = Bdd::connectBdd()->prepare("SELECT * FROM methode_niveau_user ORDER BY niveau_name ASC");
        $PDO_query_niveau->execute();

        while ($niveau = $PDO_query_niveau->fetch()) {

            $functions = '
            <a href="modif_niveau.php?id='.$niveau['niveau_id'].'" style="font-size:25px"><i class="bi bi-pencil-square"></i></a>
            <a href="#" id="delete-record" data-id="'.$niveau['niveau_id'].'" data-name="' .$niveau['niveau_name'].'" style="font-size:25px"><i class="bi bi-trash"></i></a>
            ';


            $date = date_create($niveau['niveau_date']);
            $name_user = Membre::info($_SESSION['id'], 'nom').' '.Membre::info($_SESSION['id'], 'prenom');
            $titre = $niveau['niveau_name'];
            $id = $niveau['niveau_id'];


            switch($niveau['niveau_statut'])
            {
                case '1':
                    $statut = '<div class="badge badge-light-success">Actif</div>';
                break;                         
                default:
                    $statut = '<div class="badge badge-light-danger">Non-actif</div>';
            }

            $mysql_data[] = [
                "responsive_id" => "",
                "id" => $id,
                "full_name" => $name_user,
                "titre" => $titre,
                "start_date" => date_format($date, "d/m/Y"),
                "status" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_niveau->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';

        $bdd = null;
        $PDO_query_niveau = null;


    } elseif ($job == 'add_niveau') {

        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO methode_niveau_user (`niveau_date`, `niveau_name`, `niveau_statut`, `niveau_user`)
			 VALUES (now(), :niveau_name, :niveau_statut, :niveau_user)");

            $query->bindParam(":niveau_name", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":niveau_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":niveau_user", $_POST['user'], PDO::PARAM_INT);

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

    } elseif ($job == 'del_niveau') {
        
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM methode_niveau_user WHERE niveau_id = :niveau_id");
                $query_select_del->bindParam(":niveau_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête'.$id;
           
        
    } elseif ($job == 'edit_niveau') {
        
            $query = Bdd::connectBdd()->prepare("UPDATE methode_niveau_user SET niveau_name = :niveau_name, niveau_date = NOW(), niveau_statut = :niveau_statut, niveau_user = :niveau_user  WHERE niveau_id = :niveau_id");

            $query->bindParam(":niveau_id", $_POST['id'], PDO::PARAM_INT);
            $query->bindParam(":niveau_name", $_POST['nom'], PDO::PARAM_STR);
            $query->bindParam(":niveau_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":niveau_user", $_POST['user'], PDO::PARAM_INT);
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
