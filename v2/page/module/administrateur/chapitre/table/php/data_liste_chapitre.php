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

    if ($job == 'get_liste_chapitre' || $job == 'add_comm' || $job == 'comm_edit' || $job == 'del_com') {

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
            <a href="modif_comm.php?id='.$chapitre['methode_chapitre_id'].'" class="btn btn-info btn-sm">Modifier</a>
            <a href="#" id="delete-record" data-id="' .$chapitre['methode_chapitre_id'].'" data-name="' .$chapitre['methode_chapitre_nom'].'" class="btn btn-danger btn-sm">Supprimer</a>            
            ';

            $query = Bdd::connectBdd()->prepare("SELECT methode_socle_nom FROM methode_socle WHERE methode_socle_id = :methode_socle_id");
            $query->bindParam(":methode_socle_id", $chapitre['methode_socle_id'], PDO::PARAM_INT);
            $query->execute();	
            $query_socle = $query->fetch();
            $query->closeCursor();


            $date = date_create($chapitre['methode_chapitre_date']);
            $date_create = date_format($date, "d/m/Y");

            $name_user = Membre::info($chapitre['methode_chapitre_user'], 'nom').' '.Membre::info($chapitre['methode_chapitre_user'], 'prenom');

            $chapitre = $chapitre['methode_chapitre_nom'];
            $socle = $query_socle['methode_socle_nom'];

            $chemin = '<b>'.$socle.'</b> > '.$socle;


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
                "titre" => $chemin,
                "start_date" => $date_create,
                "statut" => $statut,
                "Actions" => $functions
            ];
        }

        $PDO_query_chapitre->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        $PDO_query_chapitre = null;


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
    } elseif ($job == 'del_com') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            
                $query_select_del = Bdd::connectBdd()->prepare("DELETE FROM `etai_intranet_comm` WHERE etai_intranet_comm_id = :etai_intranet_comm_id");
                $query_select_del->bindParam(":etai_intranet_comm_id", $id, PDO::PARAM_INT);
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
