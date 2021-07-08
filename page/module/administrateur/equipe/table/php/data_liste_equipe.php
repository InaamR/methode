<?php
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

    if ($job == 'get_liste_equipee' || $job == 'add_equipe' || $job == 'del_equipe' || $job == 'get_equipe_edit' || $job == 'edit_equipe') {
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
    if ($job == 'get_liste_equipee') {

        $PDO_query_equipe_pdo = Bdd::connectBdd()->prepare("SELECT * FROM user_equipe_methode ORDER BY equipe_id DESC");
        $PDO_query_equipe_pdo->execute();

        while ($equipe = $PDO_query_equipe_pdo->fetch()) {
            $functions =
                ' 
                    <td class="product-action">

                    <center>
                    <button type="button" class="btn btn-icon btn-success" id="function_edit_equipe" data-id="' .
                    $equipe['equipe_id'] .
                    '" data-name="' .
                    $equipe['equipe_name'] .
                    '"><i class="feather icon-check-square"></i></button>
                    <button type="button" class="btn btn-icon btn-danger rounded-circle" id="confirm-color" data-id="' .
                    $equipe['equipe_id'] .
                    '" data-name="' .
                    $equipe['equipe_name'] .
                    '"><i class="feather icon-x-square"></i></button>
                    </center>

                    </td>
		
		        ';

            $date = date_create($equipe['equipe_date']);

            $abr_strong = '<b>' . $equipe['equipe_abr'] . '</b>';

            $mysql_data[] = array(
                "Equipe" => $equipe['equipe_name'],
                "Equipe_Abr" => $abr_strong,
                "Date_insertion" => date_format($date, "d/m/Y"),
                "bouton" => $functions
            );
            
        }
        $PDO_query_equipe_pdo->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';
        
    } elseif ($job == 'add_equipe') {
        try {
            $query = Bdd::connectBdd()->prepare("INSERT INTO user_equipe_methode (`equipe_name`,`equipe_abr`,`equipe_date`)
			 VALUES (:equipe_name,:equipe_abr,now())");

            $query->bindParam(":equipe_name", $_GET['nom_equipe'], PDO::PARAM_STR);
            $query->bindParam(":equipe_abr", $_GET['abreviation_equipe'], PDO::PARAM_STR);

            $query->execute();
            $query->closeCursor();

            $result = 'success';
            $message = 'Equipe ajoutée avec succés';
        } catch (PDOException $x) {
            die("Secured");
            $result = 'error';
            $message = 'Échec de requête';
        }
        $query = null;
        $bdd = null;
    } elseif ($job == 'get_equipe_edit') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                $query_select_add = Bdd::connectBdd()->prepare("SELECT * FROM user_equipe_methode WHERE equipe_id = :id");
                $query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
                $query_select_add->execute();

                while ($traitement_edit = $query_select_add->fetch()) {
                    $mysql_data[] = [
                        "nom_equipe" => $traitement_edit['equipe_name'],
                        "abreviation_equipe" => $traitement_edit['equipe_abr'],
                    ];
                }

                $query_select_add->closeCursor();

                $result = 'success';
                $message = 'Succès de requête';
            } catch (PDOException $x) {
                die("Secured");
                $result = 'error';
                $message = 'Échec de requête';
            }
            $query_del = null;
            $bdd = null;
        }
    } elseif ($job == 'edit_equipe') {
        if ($id == '') {
            $result = 'Échec';
            $message = 'Échec id';
        } else {
            $query = Bdd::connectBdd()->prepare("UPDATE user_equipe_methode SET equipe_name = :equipe_name, equipe_abr = :equipe_abr WHERE equipe_id = :equipe_id");
            $query->bindParam(":equipe_id", $id, PDO::PARAM_INT);
            $query->bindParam(":equipe_name", $_GET['nom_equipe'], PDO::PARAM_STR);
            $query->bindParam(":equipe_abr", $_GET['abreviation_equipe'], PDO::PARAM_STR);
            $query->execute();
            $query->closeCursor();
            $result = 'success';
            $message = 'Succès de requête';
        }
    } elseif ($job == 'del_equipe') {
        if ($id == '') {
            $result = 'Échec';
            $message = 'Échec id';
        } else {
            try {
                $query_del = Bdd::connectBdd()->prepare("DELETE FROM user_equipe_methode WHERE equipe_id = :id");
                $query_del->bindParam(":id", $id, PDO::PARAM_INT);
                $query_del->execute();
                $query_del->closeCursor();
                $result = 'success';
                $message = 'Succès de requête';
            } catch (PDOException $x) {
                die("Secured");
                $result = 'error';
                $message = 'Échec de requête';
            }
            $query_del = null;
            $bdd = null;
        }
    }
}

$data = array(
    "result"  => $result,
    "message" => $message,
    "data"    => $mysql_data
  );
  
  $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
  print $json_data;
?>
