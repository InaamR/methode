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
    use Phppot\DataSource;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    require_once 'DataSource.php';
    $db = new DataSource();
    $conn = $db->getConnection();
    require_once ('./vendor/autoload.php');

    if (isset($_POST["import"])) {

        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        
        if (in_array($_FILES["file"]["type"], $allowedFileType)) {

            $targetPath = 'uploads/' . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

            $bdd = new PDO('mysql:host=localhost; dbname=methode','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_LOCAL_INFILE => true));
            $insert ="LOAD DATA INFILE 'C:/xampp/htdocs/methode/page/module/administrateur/etude/uploads/".$_FILES['file']['name']."' INTO TABLE planning_prod_archive 
                CHARACTER SET UTF8    
                FIELDS TERMINATED BY ';' 
                LINES TERMINATED BY '\r\n'
                IGNORE 1 LINES";
            $prepared = $bdd->prepare($insert);
            $prepared->execute();
            $prepared->closeCursor();
            header("Location: http://localhost/methode/page/module/administrateur/etude/liste_archive.php");

        } else {
            $type = "error";
            $message = "Type de fichier invalide. Télécharger un fichier Excel";
        }
    }
?>

<!DOCTYPE html>
<html class="loading bordered-layout" lang="Fr" data-layout="bordered-layout" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?php echo'Import Archive | '.$PARAM_nom_site; ?></title>
    <link rel="apple-touch-icon" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/images/ico/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

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

<!-- BEGIN: Body-->

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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">GESTION DE LA PRODUCTION</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Planning</li>
                                    <li class="breadcrumb-item">Liste des archives</li>
                                    <li class="breadcrumb-item">Importation</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a class="btn-icon btn btn-success btn-round btn-sm waves-effect waves-float waves-light" href="liste_archive.php">Retour à la liste des archives</a>
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
                                    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
                                    <!-- Form -->
                                    <form method="post" action="" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                                            

                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group mb-2">
                                                    <label for="basic-default-nom">Archive (Champs non obligatoire) :</label>
                                                    <input
                                                    type="text"
                                                    class="form-control"
                                                    id="basic-default-nom"
                                                    name="nom"
                                                    placeholder="Maximum 250 caractéres"
                                                    maxlength="250"
                                                    value=""
                                                    
                                                    />                                                 
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">Fichiers <b>CSV</b> uniquement :</label>
                                                    <div class="custom-file">
                                                        <input type="file"  name="file" id="file" accept=".csv" required class="custom-file-input">
                                                        <label class="custom-file-label" for="customFile">Choisir votre fichier</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary mr-1" id="submit" name="import" >Importer</button>
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

    <script charset="utf-8"  src="<?php echo Admin::menusocle();?>table/js/webapp_liste_socle.js"></script>

    

    <!-- BEGIN: Page JS-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site?>/app-assets/js/scripts/ui/ui-feather.js"></script>
    <!-- END: Page JS-->
    
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <script src="https://kit.fontawesome.com/7791373c6a.js" crossorigin="anonymous"></script>
</body>
<!-- END: Body-->

</html>