<?php

$page = '';
if (empty($page)) {
    $page = "dbc";
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
    echo "Vous n'avez pas accès à ce répertoire";
} else {
    // On vérifie que la page est bien sur le serveur
    if (file_exists("../../../../../config/" . $page) && $page != 'index.php') {
        include "../../../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}
page_protect();
if (!checkAdmin()) {
    die("Secured");
    exit();
}

$job = '';
$id = '';
$st = '';

if (isset($_GET['job'])) {
    $job = $_GET['job'];

    if ($job == 'get_liste_planning' || $job == 'add_tech' || $job == 'get_user_edit' || $job == 'get_modal_plan_data' || $job == 'edit_user') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                $id = '';
            }
        }

        if (isset($_GET['st'])) {
            $st = $_GET['st'];
            if (!is_numeric($st)) {
                $st = '';
            }
        }

        if (isset($_GET['mdp'])) {
            $mdp = $_GET['mdp'];
            if (!is_numeric($mdp)) {
                $mdp = '';
            }
        }
    } else {
        $job = '';
    }
}

$mysql_data = [];

if ($job != '') {
    if ($job == 'get_liste_planning') {
        $PDO_query_planning = $bdd->prepare("SELECT * FROM planning_prod ORDER BY planning_prod_id ASC");
        $PDO_query_planning->execute();

        while ($planning = $PDO_query_planning->fetch()) {
            $query = $bdd->prepare("select count(*), user_id from planning_prod_technicien where planning_prod_id  = :planning_prod_id");
            $query->bindParam(":planning_prod_id", $planning['planning_prod_id'], PDO::PARAM_INT);
            $query->execute();
            $id_technicien = $query->fetch();
            $query->closeCursor();

            $query = $bdd->prepare("select user_fullname from users_methode where user_id  = :user_id");
            $query->bindParam(":user_id", $id_technicien['user_id'], PDO::PARAM_INT);
            $query->execute();
            $nom_technicien = $query->fetch();
            $query->closeCursor();

            $functions = '';

            $date_francaise = date('d/m/Y', strtotime($planning['planning_prod_date']));
            $livrable_date_francaise = date('F-Y', strtotime($planning['planning_prod_Livrable']));

            $functions_mdl =
                '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalScrollable" id="function_duree_traitement" data-id="' .
                $planning['planning_prod_id'] .
                '">
		Détails affectation
		</button>';

            if ($planning['planning_prod_statut'] == 0) {
                $statut = '<div class="badge badge-info mr-1 mb-1">
			<i class="feather"></i>
			<span>Terminé</span>
		</div>';
            } elseif ($planning['planning_prod_statut'] == 1) {
                $statut = '<div class="badge badge-primary mr-1 mb-1">
			<i class="feather"></i>
			<span>En cours</span>
		</div>';
            } elseif ($planning['planning_prod_statut'] == 2) {
                $statut = '<div class="badge badge-danger mr-1 mb-1">
			<i class="feather"></i>
			<span>Contrôle Q</span>
		</div>';
            } elseif ($planning['planning_prod_statut'] == 3) {
                $statut = '<div class="badge badge-warning mr-1 mb-1">
			<i class="feather"></i>
			<span>En Relecture</span>
		</div>';
            } elseif ($planning['planning_prod_statut'] == 4) {
                $statut = '<div class="badge badge-secondary mr-1 mb-1">
			<i class="feather"></i>
			<span>Non commencé</span>
		</div>';
            } else {
                $statut = '<div class="badge badge-success mr-1 mb-1">
			<i class="feather"></i>
			<span>Validé</span>
		</div>';
            }

            $nom_bd = $nom_technicien['user_fullname'];

            $out = initiales($nom_bd);
            $out_initiale = substr($out, 0, -1);

            $marque_bold = bold($planning['planning_prod_MARQUE']);
            $avatar =
                '<div class="avatar bg-secondary mr-1">
		<div class="avatar-content">' .
                $out_initiale .
                '</div>
	</div>';

            $mysql_data[] = [
                "Livrable" => $livrable_date_francaise,
                "Code_GMOD_P" => $planning['planning_prod_Code_GMOD_P'],
                "Technicien" => $avatar,
                "MARQUE" => $marque_bold,
                "GMOD_P" => $planning['planning_prod_GMOD_P'],
                "Statut" => $statut,
                "Date_insertion" => $date_francaise,
                "bouton_1" => $functions_mdl
            ];
        }
        $PDO_query_planning->closeCursor();
        $result = 'success';
        $message = 'Succès de requête';

        $bdd = null;
        $PDO_query_planning = null;
    } elseif ($job == 'add_tech') {
        $query = $bdd->prepare("INSERT INTO planning_prod_technicien (`planning_prod_technicien_date`,`planning_prod_id`,`user_id`,`menu_socle_id`,`planning_prod_technicien_date_debut`,`planning_prod_technicien_date_fin`,`planning_prod_technicien_estimation_charge`,`planning_prod_technicien_actif`,`planning_prod_technicien_actif2`,`planning_prod_technicien_actif3`)
			 VALUES (now(), :planning_prod_id, :user_id, :menu_socle_id, :planning_prod_technicien_date_debut, :planning_prod_technicien_date_fin, :planning_prod_technicien_estimation_charge, :planning_prod_technicien_actif, :planning_prod_technicien_actif2, :planning_prod_technicien_actif3)");

        $query->bindParam(":planning_prod_id", $_GET['planning_id'], PDO::PARAM_INT);
        $query->bindParam(":user_id", $_GET['nom_tech1'], PDO::PARAM_INT);
        $query->bindParam(":menu_socle_id", $_GET['nom_socle1'], PDO::PARAM_INT);
        $query->bindParam(":planning_prod_technicien_date_debut", $_GET['start_day'], PDO::PARAM_STR);
        $query->bindParam(":planning_prod_technicien_date_fin", $_GET['end_day'], PDO::PARAM_STR);
        $query->bindParam(":planning_prod_technicien_estimation_charge", $_GET['charge'], PDO::PARAM_INT);

        if (empty($_GET['actif'])) {
            $null = "0";
            $query->bindParam(":planning_prod_technicien_actif", $null, PDO::PARAM_INT);
        } else {
            $query->bindParam(":planning_prod_technicien_actif", $_GET['actif'], PDO::PARAM_INT);
        }

        if (empty($_GET['actif_2'])) {
            $null = "0";
            $query->bindParam(":planning_prod_technicien_actif2", $null, PDO::PARAM_INT);
        } else {
            $query->bindParam(":planning_prod_technicien_actif2", $_GET['actif_2'], PDO::PARAM_INT);
        }

        if (empty($_GET['actif_3'])) {
            $null = "0";
            $query->bindParam(":planning_prod_technicien_actif3", $null, PDO::PARAM_INT);
        } else {
            $query->bindParam(":planning_prod_technicien_actif3", $_GET['actif_3'], PDO::PARAM_INT);
        }

        $query->execute();
        $query->closeCursor();

        $result = 'success';
        $message = 'Rédacteur ajouté avec succés';

        $query = null;
        $bdd = null;
    } elseif ($job == 'get_modal_plan_data') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                $query_select_add = $bdd->prepare("SELECT * FROM planning_prod WHERE planning_prod_id = :id");
                $query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
                $query_select_add->execute();
                $traitement_edit = $query_select_add->fetch();

                $date_fin_francaise = date('d/m/Y', strtotime($traitement_edit['planning_prod_date_fin']));
                $date_deb_francaise = date('d/m/Y', strtotime($traitement_edit['planning_prod_date_debut']));

                if ($traitement_edit['planning_prod_prestation_md'] == 0) {
                    $prestation_md = "CREA";
                } else {
                    $prestation_md = "UPGR";
                }

                if ($traitement_edit['planning_prod_prestation_pe'] == 0) {
                    $prestation_pe = "CREA_PE";
                } elseif ($traitement_edit['planning_prod_prestation_pe'] == 1) {
                    $prestation_pe = "MAJ_PE";
                } else {
                    $prestation_pe = "OK";
                }

                $mysql_data[] = [
                    "estimation_moyenne_jrs" => $traitement_edit['planning_prod_estimation_moyenne_jrs'],
                    "estimation_charge" => $traitement_edit['planning_prod_estimation_charge'],
                    "date_debut" => $date_deb_francaise,
                    "date_fin" => $date_fin_francaise,
                    "nbre_de_jours_reels" => $traitement_edit['planning_prod_nbre_de_jours_reels'],
                    "remarques" => $traitement_edit['planning_prod_remarques'],
                    "prestation_md" => $prestation_md,
                    "prestation_pe" => $prestation_pe,
                    "var_ident" => $traitement_edit['planning_prod_var_ident'],
                    "var_se" => $traitement_edit['planning_prod_var_se'],
                    "planning_prod_id" => $traitement_edit['planning_prod_id'],
                ];

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
    } elseif ($job == 'get_user_edit') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                $query_select_add = $bdd->prepare("SELECT * FROM users WHERE id = :id");
                $query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
                $query_select_add->execute();

                while ($traitement_edit = $query_select_add->fetch()) {
                    $mysql_data[] = [
                        "equipe" => $traitement_edit['equipe_id'],
                        "full_name" => $traitement_edit['full_name'],
                        "ip" => $traitement_edit['tel_ip'],
                        "matricule" => $traitement_edit['user_matricule'],
                        "niveau" => $traitement_edit['user_level'],
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
    } elseif ($job == 'edit_user') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                $query = $bdd->prepare("select count(*) from users where user_name = :user_name OR user_email = :user_email");
                $query->bindParam(":user_name", $_GET['user_name'], PDO::PARAM_STR);
                $query->bindParam(":user_email", $_GET['user_email'], PDO::PARAM_STR);
                $query->execute();
                $dups = $query->fetchColumn();
                $query->closeCursor();

                if ($dups > 0) {
                    $result = 'error';
                    $message = 'Le nom ou l\'adresse mail existe déjà dans la base';
                } else {
                    if (empty($_GET['user_email'])) {
                        $query = $bdd->prepare("UPDATE users SET full_name = :full_name, user_name = :user_name, user_level = :user_level, tel_ip = :tel_ip, user_matricule = :user_matricule, equipe_id = :equipe_id WHERE id = :id");
                    } else {
                        $email = $_GET['user_email'];
                        $query = $bdd->prepare(
                            "UPDATE users SET full_name = :full_name, user_name = :user_name, user_email = :user_email, user_level = :user_level, tel_ip = :tel_ip, user_matricule = :user_matricule, equipe_id = :equipe_id WHERE id = :id"
                        );
                        $query->bindParam(":user_email", $email, PDO::PARAM_INT);
                    }

                    $query->bindParam(":id", $id, PDO::PARAM_INT);
                    $query->bindParam(":full_name", $_GET['full_name'], PDO::PARAM_STR);
                    $query->bindParam(":user_name", $_GET['full_name'], PDO::PARAM_INT);
                    $query->bindParam(":user_level", $_GET['niveau'], PDO::PARAM_INT);
                    $query->bindParam(":tel_ip", $_GET['ip'], PDO::PARAM_INT);
                    $query->bindParam(":user_matricule", $_GET['matricule'], PDO::PARAM_INT);
                    $query->bindParam(":equipe_id", $_GET['equipe'], PDO::PARAM_INT);
                    $query->execute();
                    $query->closeCursor();

                    $result = 'success';
                    $message = 'Utilisateur modifié avec succès';
                }
            } catch (PDOException $x) {
                die("Secured");
                $result = 'error';
                $message = 'Échec de requête';
            }
            $query_del = null;
            $bdd = null;
        }
    } elseif ($job == 'user_statut') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                if ($st == 0) {
                    $query = $bdd->prepare("UPDATE users SET banned = 1, approved = 0 WHERE id = :id");
                    $query->bindParam(":id", $id, PDO::PARAM_INT);
                    $query->execute();
                    $query->closeCursor();
                    $result = 'success';
                    $message = 'Utilisateur modifier avec succès';
                } elseif ($st == 1) {
                    $query = $bdd->prepare("UPDATE users SET banned = 0, approved = 1 WHERE id = :id");
                    $query->bindParam(":id", $id, PDO::PARAM_INT);
                    $query->execute();
                    $query->closeCursor();
                    $result = 'success';
                    $message = 'Utilisateur modifier avec succès';
                }
            } catch (PDOException $x) {
                die("Secured");
                $result = 'error';
                $message = 'Échec de requête';
            }
            $query = null;
            $bdd = null;
        }
    } elseif ($job == 'user_mdp') {
        if ($id == '') {
            $result = 'error';
            $message = 'Échec id';
        } else {
            try {
                $hash = PwdHash('Wellcome01');
                $query = $bdd->prepare("UPDATE users SET pwd = :pwd, date_reni = now() WHERE id = :id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $query->bindParam(":pwd", $hash, PDO::PARAM_STR);
                $query->execute();
                $query->closeCursor();
                $result = 'success';
                $message = 'Utilisateur modifier avec succès';
            } catch (PDOException $x) {
                die("Secured");
                $result = 'error';
                $message = 'Échec de requête';
            }
            $query = null;
            $bdd = null;
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
