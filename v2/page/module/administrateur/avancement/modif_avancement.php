<?php 

session_start();

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
    if (file_exists("../../../../config/" . $page) && $page != 'index.php') {
        include "../../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}
if(empty($_SESSION['id'])){

    ProtectEspace::administrateur("", "", "");

}else{

    ProtectEspace::administrateur($_SESSION['id'], $_SESSION['jeton'], $_SESSION['niveau']);

}
if(!empty($_GET["id"])){$id_avancement = $_GET["id"];}else{$id_avancement = "";}


$PDO_query_avancement_unique = Bdd::connectBdd()->prepare("SELECT * FROM avancement_technicien WHERE avancement_technicien_id = :id ORDER BY avancement_technicien_id ASC");
$PDO_query_avancement_unique->bindParam(":id", $id_avancement, PDO::PARAM_INT);
$PDO_query_avancement_unique->execute();
$avancement = $PDO_query_avancement_unique->fetch();
$PDO_query_avancement_unique->closeCursor();
?>

<!DOCTYPE html>
<html class="loading bordered-layout" lang="Fr" data-layout="bordered-layout" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?php if(!empty($_GET["id"])){echo'Avancement | Modification - '.$PARAM_nom_site.'';}else{echo'Avancement | Ajout - '.$PARAM_nom_site.'';} ?></title>
    <link rel="apple-touch-icon" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/images/ico/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/pages/ui-feather.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/plugins/forms/form-quill-editor.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/pages/page-blog.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">    
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->


<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-collapsed pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?php
        $page = '';
        if (empty($page)) {
        $page = "top";
        // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
        // On supprime également d'éventuels espaces
        $page = trim($page.".php");
        
        }
        
        // On évite les caractères qui permettent de naviguer dans les répertoires
        $page = str_replace("../","protect",$page);
        $page = str_replace(";","protect",$page);
        $page = str_replace("%","protect",$page);
        
        // On interdit l'inclusion de dossiers protégés par htaccess
        if (preg_match("/include/",$page)) {
        echo "Vous n'avez pas accès à ce répertoire";
        }
        
        else {
        
            // On vérifie que la page est bien sur le serveur
            if (file_exists("../../../include/".$page) && $page != 'index.php') {
            include("../../../include/".$page); 
            }
        
            else {
                echo "Page inexistante !";
            }
        }
	
	?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php
        $page = '';
        if (empty($page)) {
        $page = "menu";
        // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
        // On supprime également d'éventuels espaces
        $page = trim($page.".php");
        
        }
        
        // On évite les caractères qui permettent de naviguer dans les répertoires
        $page = str_replace("../","protect",$page);
        $page = str_replace(";","protect",$page);
        $page = str_replace("%","protect",$page);
        
        // On interdit l'inclusion de dossiers protégés par htaccess
        if (preg_match("/include/",$page)) {
        echo "Vous n'avez pas accès à ce répertoire";
        }
        
        else {
        
            // On vérifie que la page est bien sur le serveur
            if (file_exists("../../../include/".$page) && $page != 'index.php') {
            include("../../../include/".$page); 
            }
        
            else {
                echo "Page inexistante !";
            }
        }
	
	?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-8 col-8 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">PLANNING</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb d-md-flex d-none">
                                    <li class="breadcrumb-item">
                                        <a href="liste_avancement.php">Avancement</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestion d'avancement</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-4 col-4">
                    <div class="form-group breadcrumb-right float-right d-flex">
                        <a class="btn btn-success" href="liste_avancement.php">Retour à la liste</a>
                    </div>
                </div>
            </div>
            <!-- Begin : main content -->
            <div class="content-body">
                <!-- Blog Edit -->
                <div class="blog-edit-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media mb-2">
                                        <div class="avatar mr-75">
                                            <img src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/images/portrait/small/man.png" width="38" height="38" alt="Avatar" />
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-25"><?php echo Membre::info($_SESSION['id'], 'nom').' '.Membre::info($_SESSION['id'], 'prenom');?></h6>
                                            <p class="card-text"><?php echo $date = date("d-m-Y");?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Form -->
                                    <form method="post" id="jquery-val-form" class="<?php if(empty($avancement_technicien_id)){echo 'add';}else{echo 'edit';} ?>" data-id="<?php echo $avancement_technicien_id; ?>">
                                                            
                                        <input name="user" type="hidden" value="<?php echo Membre::info($_SESSION['id'], 'nom').' '.Membre::info($_SESSION['id'], 'prenom');?>">
                                        <input name="avancement_technicien_id" type="hidden" value="<?php echo $avancement_technicien_id;?>">

                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="basic-default-nom">Estimation moyenne par jour *:</label>
                                                    <input
                                                    type="text"
                                                    class="form-control"
                                                    id="basic-default-nom"
                                                    name="nom"
                                                    placeholder="..."
                                                    maxlength="255"
                                                    value="<?php if(!empty($avancement_technicien_id)){echo $avancement['avancement_technicien_estimation_moyenne_jrs   '];}?>"
                                                    required
                                                    />                                                 
                                                </div>
                                            </div>


                                            <!-- <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="basic-default-abr">Date de fin *:</label>
                                                    <input type="date" id="basic-default-abr" class="form-control" name="date_fin" value="<?php
                                                            if(!empty($avancement_technicien_id))
                                                            {echo $avancement['avancement_technicien_date_fin'];}                                                           
                                                            ?>" placeholder="..." required/>
                                                    
                                                </div>
                                            </div> -->

                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="basic-default-abr">Nombre de jours réels *:</label>
                                                    <input type="text" id="basic-default-abr" class="form-control" name="nbr_j_reels" value="<?php
                                                            if(!empty($avancement_technicien_id))
                                                            {echo $avancement['avancement_technicien_nbre_jours_reels'];}                                                           
                                                            ?>" placeholder="..." required/>
                                                    
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="blog-edit-statut">Statut de l'étude *:</label>
                                                    <select class="select2 form-control" id="blog-edit-statut" name="statut" required>

                                                        <?php 
                                                                switch($avancement['avancement_technicien_statut'])
                                                                {
                                                                    
                                                                    case '1':
                                                                            echo '
                                                                            <option value="1" selected>Active</option>
                                                                            <option value="0">Inactive</option>
                                                                            ';
                                                                        
                                                                    break;
                                                                    
                                                                    case '0':
                                                                            echo '
                                                                            <option value="1">Active</option>
                                                                            <option value="0" selected>Inactive</option>
                                                                            ';
                                                                        
                                                                    break;

                                                                    default:
                                                                        echo '
                                                                        <option value="1" selected>Active</option>
                                                                        <option value="0">Inactive</option>
                                                                        ';
                                                                    
                                                                }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary mr-1">Enregistrement</button>
                                                <button type="reset" class="btn btn-outline-secondary">Vider les champs</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Blog Edit -->
            </div>
            <!-- End : main content -->

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php
        $page = '';
        if (empty($page)) {
        $page = "footer";
        // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
        // On supprime également d'éventuels espaces
        $page = trim($page.".php");
        
        }
        
        // On évite les caractères qui permettent de naviguer dans les répertoires
        $page = str_replace("../","protect",$page);
        $page = str_replace(";","protect",$page);
        $page = str_replace("%","protect",$page);
        
        // On interdit l'inclusion de dossiers protégés par htaccess
        if (preg_match("/include/",$page)) {
        echo "Vous n'avez pas accès à ce répertoire";
        }
        
        else {
        
            // On vérifie que la page est bien sur le serveur
            if (file_exists("../../../include/".$page) && $page != 'index.php') {
            include("../../../include/".$page); 
            }
        
            else {
                echo "Page inexistante !";
            }
        }
        
	?> 
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/core/app-menu.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/core/app.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/scripts/pages/page-blog-edit.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/scripts/forms/form-validation.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/scripts/extensions/ext-component-blockui.js"></script>
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page JS-->

    <script charset="utf-8"  src="<?php echo Admin::menuavancement();?>table/js/webapp_liste_avancement.js"></script>
    

    <script>        
 
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
        
    </script>    

    <script src="https://kit.fontawesome.com/7791373c6a.js" crossorigin="anonymous"></script>

</body>
</html>