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

    if ($job == 'get_liste_equipe' || $job == 'add_equipe' || $job == 'equipe_edit' || $job == 'del_equipe') {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
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
    if ($job == 'get_liste_equipe') {

        $PDO_query_equipe = Bdd::connectBdd()->prepare("SELECT * FROM user_equipe_methode ORDER BY equipe_name ASC");
        $PDO_query_equipe->execute();

        while ($equipe = $PDO_query_equipe->fetch()) {

            $functions = '
            <a href="modif_equipe.php?id='.$equipe['equipe_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a href="#" id="delete-record" data-id="' .$equipe['equipe_id'].'" data-name="' .$equipe['equipe_name'].'" class="btn btn-danger btn-sm">Supprimer</a>
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


    } elseif ($job == 'add_comm') {
        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO etai_intranet_comm (`etai_intranet_comm_titre`, `etai_intranet_comm_sous_titre`, `etai_intranet_comm_date`, `etai_intranet_comm_desc`, `etai_intranet_comm_img`, `etai_intranet_comm_statut`, `etai_intranet_comm_cat`, `etai_intranet_comm_email_user`, `etai_intranet_comm_user`)
			 VALUES (:comm_titre, :comm_sous_titre, now(), :article, :img, :statut, :cat, :email, :user)");

            $query->bindParam(":comm_titre", $_POST['titre'], PDO::PARAM_STR);
            $query->bindParam(":comm_sous_titre", $_POST['stitre'], PDO::PARAM_STR);
            $query->bindParam(":article", $_POST['article'], PDO::PARAM_STR);
            $query->bindParam(":img", $_POST['img'], PDO::PARAM_STR);
            $query->bindParam(":statut", $_POST['statut'], PDO::PARAM_INT);
            $query->bindParam(":cat", $_POST['cat'], PDO::PARAM_INT);
            $query->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
            $query->bindParam(":user", $_POST['user'], PDO::PARAM_STR);

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
        $bdd = null;



        
    } elseif ($job == 'del_equipe') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM `user_equipe_methode` WHERE equipe_id = :equipe_id");
                $query_select_del->bindParam(":equipe_id", $id, PDO::PARAM_INT);
                $query_select_del->execute(); 
                $query_select_del->closeCursor();

                $result = 'success';
                $message = 'Succès de requête';
           
        }
    } elseif ($job == 'comm_edit') {
        if ($id == '') {
            $result = 'Échec';
            $message = 'Échec id';
        } else {
            $query = Bdd::connectBdd()->prepare("UPDATE etai_intranet_comm SET etai_intranet_comm_user = :etai_intranet_comm_user, etai_intranet_comm_email_user = :etai_intranet_comm_email_user, etai_intranet_comm_date = NOW(), etai_intranet_comm_cat = :etai_intranet_comm_cat, etai_intranet_comm_titre = :etai_intranet_comm_titre, etai_intranet_comm_sous_titre = :etai_intranet_comm_sous_titre, etai_intranet_comm_desc = :etai_intranet_comm_desc, etai_intranet_comm_img = :etai_intranet_comm_img, etai_intranet_comm_statut = :etai_intranet_comm_statut  WHERE etai_intranet_comm_id = :etai_intranet_comm_id");
            $query->bindParam(":etai_intranet_comm_id", $id, PDO::PARAM_INT);
            $query->bindParam(":etai_intranet_comm_user", $_POST['user'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_email_user", $_POST['email'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_cat", $_POST['cat'], PDO::PARAM_INT);
            $query->bindParam(":etai_intranet_comm_titre", $_POST['titre'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_sous_titre", $_POST['stitre'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_desc", $_POST['article'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_img", $_POST['img'], PDO::PARAM_STR);
            $query->bindParam(":etai_intranet_comm_statut", $_POST['statut'], PDO::PARAM_INT);
            $query->execute();
            $query->closeCursor();
            $result = 'success';
            $message = 'Succès de requête';
        }
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
