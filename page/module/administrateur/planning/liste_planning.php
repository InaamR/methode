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
    if (file_exists("../../../config/" . $page) && $page != 'index.php') {
        include "../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}
page_protect();
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Planning</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/select/select2.min.css">
    <!-- END: Vendor CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php
    $page = '';
    if (empty($page)) {
        $page = "top";
        // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
        // On supprime également d'éventuels espaces
        $page = trim($page . ".php");
    }

    // On évite les caractères qui permettent de naviguer dans les répertoires
    $page = str_replace("../", "protect", $page);
    $page = str_replace(";", "protect", $page);
    $page = str_replace("%", "protect", $page);

    // On interdit l'inclusion de dossiers protégés par htaccess
    if (preg_match("/include/", $page)) {
        echo "Vous n'avez pas accès à ce répertoire";
    } else {
        // On vérifie que la page est bien sur le serveur
        if (file_exists("../../include/" . $page) && $page != 'index.php') {
            include "../../include/" . $page;
        } else {
            echo "Page inexistante !";
        }
    }
    ?>    
    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center"><a class="pb-25" href="#">
                <h6 class="text-primary mb-0">Files</h6>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="../app-assets/images/icons/xls.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="../app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="../app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="../app-assets/images/icons/doc.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
            </a></li>
        <li class="d-flex align-items-center"><a class="pb-25" href="#">
                <h6 class="text-primary mb-0">Members</h6>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="../app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="../app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="../app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="../app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
     <?php
     $page = '';
     if (empty($page)) {
         $page = "menu";
         // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
         // On supprime également d'éventuels espaces
         $page = trim($page . ".php");
     }

     // On évite les caractères qui permettent de naviguer dans les répertoires
     $page = str_replace("../", "protect", $page);
     $page = str_replace(";", "protect", $page);
     $page = str_replace("%", "protect", $page);

     // On interdit l'inclusion de dossiers protégés par htaccess
     if (preg_match("/include/", $page)) {
         echo "Vous n'avez pas accès à ce répertoire";
     } else {
         // On vérifie que la page est bien sur le serveur
         if (file_exists("../../include/" . $page) && $page != 'index.php') {
             include "../../include/" . $page;
         } else {
             echo "Page inexistante !";
         }
     }
     ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">ADMINISTRATION</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Planning</a>
                                    </li>
                                    <li class="breadcrumb-item active">Liste
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
    			<!-- Column selectors with Export Options and print table -->
                <section id="data-list-view" class="data-list-view-header">
                    <div class="row">
                    <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- basic buttons -->
                                                  <button type="button" class="btn btn-success ction-edit float-right" id="add_socle"  tabindex="0" aria-controls="DataTables_Table_0">Nouveau planning</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                           </div>
                    
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-content">
                                    <div class="card-body card-dashboard">                                        
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors " id="table_planning_prod">
                                                <thead>
                                                    <tr>
                                                        <th>Livrable</th> 
                                                        <th>Code_GMOD_P</th>
                                                        <th>Technicien</th>
                                                        <th>MARQUE</th>
                                                        <th>GMOD_P</th>
                                                        <th>Statut</th>                                                    
                                                        <th>Date d'insertion</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    	<th>Livrable</th> 
                                                        <th>Code_GMOD_P</th> 
                                                        <th>Technicien</th>
                                                        <th>MARQUE</th>
                                                        <th>GMOD_P</th>
                                                        <th>Statut</th>                                                   
                                                        <th>Date d'insertion</th>                                                        
                                                        <th></th>
                                                        
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <!-- add new sidebar starts -->
                    <div class="add-new-data-sidebar">
                        <div class="overlay-bg"></div>
                        <div class="add-new-data">
                            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                                <div>
                                    <h4 id="titre_h4"></h4>
                                </div>
                                <div class="hide-data-sidebar">
                                    <i class="feather icon-x"></i>
                                </div>
                            </div>
							<form class="form add" id="form_company" data-id="">

                            <div class="data-items pb-3">
                                <div class="data-fields px-2 mt-3">
                                    <div class="row">
                                    
                                        <div class="col-sm-12 data-field-col">
                                        
                                        
                                        
                                        
                                        
                                        	
                                            <label for="nom_chapitre">Nom du chapitre*</label>
                                            <div class="field_container">
                                            <input type="text" class="form-control" id="nom_chapitre" name="nom_chapitre" required>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="col-sm-12 data-field-col">
                                            <label for="nom_socle">Nom du socle*</label>
                                            <div class="field_container">
                                            <input type="text" class="form-control" id="nom_socle" name="nom_socle" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                <div class="add-data-btn">
                                    <button class="btn btn-primary" type="submit" id="btn_ok"></button>
                                </div>
                                <div class="cancel-data-btn">
                                    <button class="btn btn-outline-danger" type="reset">Annuler</button>
                                </div>
                            </div>
							
                            </form>
                        </div>
                    </div>
                    <!-- add new sidebar ends -->


                </section>
                <!-- Column selectors with Export Options and print table -->
                </div>
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
        $page = trim($page . ".php");
    }

    // On évite les caractères qui permettent de naviguer dans les répertoires
    $page = str_replace("../", "protect", $page);
    $page = str_replace(";", "protect", $page);
    $page = str_replace("%", "protect", $page);

    // On interdit l'inclusion de dossiers protégés par htaccess
    if (preg_match("/include/", $page)) {
        echo "Vous n'avez pas accès à ce répertoire";
    } else {
        // On vérifie que la page est bien sur le serveur
        if (file_exists("../../include/" . $page) && $page != 'index.php') {
            include "../../include/" . $page;
        } else {
            echo "Page inexistante !";
        }
    }
    ?>
    

    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                   
<section id="nav-filled">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card overflow-hidden">
                                
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">Détails</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Affectation</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content pt-1">
                                            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
<!-- Striped rows start -->
<div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-content">
                                
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Estimation moyenne (jrs)</th>
                                                <td id="estimation_moyenne_jrs"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Estimation charge</th>
                                                <td id="estimation_charge"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Date début</th>
                                                <td id="date_debut"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Date fin</th>
                                                <td id="date_fin"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nbre de jours réels</th>
                                                <td id="nbre_de_jours_reels"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Remarques</th>
                                                <td id="remarques"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Prestation_MD</th>
                                                <td id="prestation_md"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Prestation_PE</th>
                                                <td id="prestation_pe"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">VAR_Ident</th>
                                                <td id="var_ident"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">VAR_SE</th>
                                                <td id="var_se"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<!-- Striped rows end -->
                                            </div>
                                      <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                            <div class="col-sm-12 data-field-col">
                                                
<!-- Vertical Tabs start -->
<section id="vertical-tabs">
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card overflow-hidden">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="nav-vertical">
                                            <ul class="nav nav-tabs nav-left flex-column" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab" aria-selected="true">1er rédacteur</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" role="tab" aria-selected="false">2éme rédacteur</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" role="tab" aria-selected="false">3éme rédacteur</a>
                                                </li>
                                            </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">

                                                            <form class="form add" id="form_company_tech1" data-id="">

                                                                <input type="hidden" id="planning_id" name="planning_id" value="">

                                                                <input type="hidden" id="actif" name="actif" value="1">


                                                                <div class="form-group">


                                                                <label for="nom_tech1"><b>Sélectionner le nom du 1er rédacteur</b></label>
                                                                <div class="field_container">
                                                                <select class="select1 form-control" name="nom_tech1"  id="nom_tech1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM users_methode");
                                                                $query->execute();
                                                                while ($query_users = $query->fetch()) {
                                                                    echo '<option value="' . $query_users['user_id'] . '">' . $query_users['user_fullname'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>
                                                                </select>
                                                                </div>


                                                                </div>
                                                                <div class="form-group">


                                                                <label for="nom_socle1">Sélectionner le socle</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_socle1"  id="nom_socle1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_socle");
                                                                $query->execute();
                                                                while ($query_socle = $query->fetch()) {
                                                                    echo '<option value="' . $query_socle['menu_socle_id'] . '">' . $query_socle['menu_socle_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>                                                                   
                                                                </select>
                                                                </div>

                                                                </div>

                                                                <div class="form-group">


                                                                <label for="nom_chp1">Sélectionner le chapitre</label>
                                                                <div class="field_container">
                                                                <select class="form-control" name="nom_chp1"  id="nom_chp1">
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_chapitre");
                                                                $query->execute();
                                                                while ($query_chap = $query->fetch()) {
                                                                    echo '<option value="' . $query_chap['menu_chapitre_id'] . '" class="' . $query_chap['menu_socle_id'] . '">' . $query_chap['menu_chapitre_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>                                                                   
                                                                </select>
                                                                </div>

                                                                </div>



                                                                <div class="form-group">


                                                                <label for="nom_sous_chapitre1">Sélectionner le sous chapitre</label>
                                                                <div class="field_container">
                                                                <select class="form-control" name="nom_sous_chapitre1"  id="nom_sous_chapitre1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_sous_chapitre");
                                                                $query->execute();
                                                                while ($query_sous_chapitre = $query->fetch()) {
                                                                    echo '<option value="' . $query_sous_chapitre['menu_sous_chapitre_id'] . '" class="' . $query_sous_chapitre['menu_chapitre_id'] . '">' . $query_sous_chapitre['menu_sous_chapitre_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>   
                                                                
                                                                </select>
                                                                </div>
                                                                </div>
                                                                <div class="form-group">


                                                                <label for="start_day">Date de début</label>
                                                                <div class="field_container">
                                                                <input type="date" id="start_day" name="start_day" class="form-control">
                                                                </div>
                                                                </div>
                                                                <div class="form-group">

                                                                <label for="end_day">Date de fin</label>
                                                                <div class="field_container">
                                                                <input type="date" id="end_day" name="end_day" class="form-control">
                                                                </div>
                                                                </div>
                                                                <div class="form-group">
                                                                <label for="charge">Estimation de charge</label>
                                                                <div class="field_container">
                                                                <input type="text" id="charge" name="charge" class="form-control">
                                                                </div>
                                                                </div>
                                                                <div class="form-group">
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" id="btn_ok_tech1">Affecter</button>
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Terminer</button>
                                                                </div>

                                                                </div>
                                                            </form>
                                                    </div>






















                                                    <div class="tab-pane" id="tabVerticalLeft2" role="tabpane2" aria-labelledby="baseVerticalLeft-tab2">
                                                            <form class="form add" id="form_company_tech2" data-id="">

                                                                <input type="hidden" id="planning_id" name="planning_id" value="">
                                                                <input type="hidden" id="actif_2" name="actif_2" value="1">
                                                                <label for="nom_tech1">Sélectionner le nom du 2éme rédacteur</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_tech1"  id="nom_tech1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM users_methode");
                                                                $query->execute();
                                                                while ($query_users = $query->fetch()) {
                                                                    echo '<option value="' . $query_users['user_id'] . '">' . $query_users['user_fullname'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>
                                                                <!-- <option value=""></option>
                                                                <option value="Med Inaam RACHDI">Med Inaam RACHDI</option>
                                                                <option value="Malek MENCHAOUI">Malek MENCHAOUI</option>
                                                                <option value="Zied JLASSI">Zied JLASSI</option> -->
                                                                </select>
                                                                </div>

                                                            
                                                                <label for="nom_socle1">Sélectionner le socle</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_socle1"  id="nom_socle1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_socle");
                                                                $query->execute();
                                                                while ($query_socle = $query->fetch()) {
                                                                    echo '<option value="' . $query_socle['menu_socle_id'] . '">' . $query_socle['menu_socle_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>   
                                                                <!-- <option value=""></option>
                                                                <option value="Entretien_Niv1">Entretien_Niv1</option>
                                                                <option value="Entretien_Niv2">Entretien_Niv2</option>
                                                                <option value="Entretien_Niv3">Entretien_Niv3</option>
                                                                <option value="Plan">Plan</option>
                                                                <option value="tous périmètres">tous périmètres</option> -->
                                                                </select>
                                                                </div>

                                                                <label for="nom_sous_chapitre1">Sélectionner le sous chapitre</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_sous_chapitre1"  id="nom_sous_chapitre1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_sous_chapitre");
                                                                $query->execute();
                                                                while ($query_sous_chapitre = $query->fetch()) {
                                                                    echo '<option value="' . $query_sous_chapitre['menu_sous_chapitre_id'] . '">' . $query_sous_chapitre['menu_sous_chapitre_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>   
                                                                
                                                                </select>
                                                                </div>

                                                                <label for="start_day">Date de début</label>
                                                                <div class="field_container">
                                                                <input type="date" id="start_day" name="start_day" class="form-control">
                                                                </div>


                                                                <label for="end_day">Date de fin</label>
                                                                <div class="field_container">
                                                                <input type="date" id="end_day" name="end_day" class="form-control">
                                                                </div>
                                                                
                                                                <label for="charge">Estimation de charge</label>
                                                                <div class="field_container">
                                                                <input type="text" id="charge" name="charge" class="form-control">
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" id="btn_ok_tech2">Affecter</button>
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Terminer</button>
                                                                </div>
                                                            </form>
                                                    </div>




















                                                    <div class="tab-pane" id="tabVerticalLeft3" role="tabpane3" aria-labelledby="baseVerticalLeft-tab3">
                                                            <form class="form add" id="form_company_tech3" data-id="">

                                                                <input type="hidden" id="planning_id" name="planning_id" value="">
                                                                <input type="hidden" id="actif_3" name="actif_3" value="1">
                                                                <label for="nom_tech1">Sélectionner le nom du 3éme rédacteur</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_tech1"  id="nom_tech1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM users_methode");
                                                                $query->execute();
                                                                while ($query_users = $query->fetch()) {
                                                                    echo '<option value="' . $query_users['user_id'] . '">' . $query_users['user_fullname'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>
                                                                <!-- <option value=""></option>
                                                                <option value="Med Inaam RACHDI">Med Inaam RACHDI</option>
                                                                <option value="Malek MENCHAOUI">Malek MENCHAOUI</option>
                                                                <option value="Zied JLASSI">Zied JLASSI</option> -->
                                                                </select>
                                                                </div>

                                                            
                                                                <label for="nom_socle1">Sélectionner le socle</label>
                                                                <div class="field_container">
                                                                <select class="select2 form-control" name="nom_socle1"  id="nom_socle1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_socle");
                                                                $query->execute();
                                                                while ($query_socle = $query->fetch()) {
                                                                    echo '<option value="' . $query_socle['menu_socle_id'] . '">' . $query_socle['menu_socle_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>   
                                                                <!-- <option value=""></option>
                                                                <option value="Entretien_Niv1">Entretien_Niv1</option>
                                                                <option value="Entretien_Niv2">Entretien_Niv2</option>
                                                                <option value="Entretien_Niv3">Entretien_Niv3</option>
                                                                <option value="Plan">Plan</option>
                                                                <option value="tous périmètres">tous périmètres</option> -->
                                                                </select>
                                                                </div>

                                                                <label for="nom_sous_chapitre1">Sélectionner le sous chapitre</label>
                                                                <div class="field_container">
                                                                <select class="form-control" name="nom_sous_chapitre1"  id="nom_sous_chapitre1" required>
                                                                <option value=""></option>
                                                                <?php
                                                                $query = $bdd->prepare("SELECT * FROM menu_sous_chapitre");
                                                                $query->execute();
                                                                while ($query_sous_chapitre = $query->fetch()) {
                                                                    echo '<option value="' . $query_sous_chapitre['menu_sous_chapitre_id'] . '">' . $query_sous_chapitre['menu_sous_chapitre_nom'] . '</option>';
                                                                }
                                                                $query->closeCursor();
                                                                ?>   
                                                                
                                                                </select>
                                                                </div>

                                                                <label for="start_day">Date de début</label>
                                                                <div class="field_container">
                                                                <input type="date" id="start_day" name="start_day" class="form-control">
                                                                </div>


                                                                <label for="end_day">Date de fin</label>
                                                                <div class="field_container">
                                                                <input type="date" id="end_day" name="end_day" class="form-control">
                                                                </div>
                                                                
                                                                <label for="charge">Estimation de charge</label>
                                                                <div class="field_container">
                                                                <input type="text" id="charge" name="charge" class="form-control">
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success" id="btn_ok_tech3">Affecter</button>
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Terminer</button>
                                                                </div>
                                                            </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</section>
                <!-- Vertical Tabs end -->                                        

                                            </div>
                                        </div>  

                                                                               
                                                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>              

                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>  
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS
    <script src="../app-assets/js/scripts/datatables/datatable.js"></script>-->
    <!-- END: Page JS-->
    <script charset="utf-8" src="module/planning/table/js/webapp_liste_planning.js"></script>
    
    
    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->




    <script src="module/planning/table/js/jquery.chained.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
               $(function () {
                   $("#nom_chp1").chained("#nom_socle1");
               });

               $(function () {
                   $("#nom_sous_chapitre1").chained("#nom_chp1");
               });

               
   </script>




</body>
<!-- END: Body-->

</html>