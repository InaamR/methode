<?php
$page = '';
if (empty($page)) {
 $page = "dbc";
 // On limite l'inclusion aux fichiers.php en ajoutant dynamiquement l'extension
 // On supprime également d'éventuels espaces
 $page = trim($page.".php");

}

// On évite les caractères qui permettent de naviguer dans les répertoires
$page = str_replace("../","protect",$page);
$page = str_replace(";","protect",$page);
$page = str_replace("%","protect",$page);

// On interdit l'inclusion de dossiers protégés par htaccess
if (preg_match("/config/",$page)) {
 echo "Vous n'avez pas accès à ce répertoire";
 }

else {

    // On vérifie que la page est bien sur le serveur
    if (file_exists("../../../config/".$page) && $page != 'index.php') {
       include("../../../config/".$page); 
    }

    else {
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
    <title>Ajouter une identité véhicule</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/sweetalert2.min.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/validation/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
	
    
    <link rel="stylesheet" href="module/identite_vehicule/table/css/layout_identite_vehicule.css">
    
 

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
		if (file_exists("../../include/".$page) && $page != 'index.php') {
		   include("../../include/".$page); 
		}
	
		else {
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
		if (file_exists("../../include/".$page) && $page != 'index.php') {
		   include("../../include/".$page); 
		}
	
		else {
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
                                    <li class="breadcrumb-item"><a href="#">Ajouter une identité véhicule</a>
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
                    
                    
				   <!-- add new sidebar starts -->
     <div class="page-content">
        <div class="col-12">
            <div class="card">
                           
            <div class="container-fluid">
            
            <div class="row">
            <div class="col-lg-12">
              <div class="widget widget-welcome">
                <div class="widget-welcome__message">
                <?php if(!empty($_GET['mode']) && $_GET['mode'] == 'update'){
                  	echo '<h4 class="widget-welcome__message-l1">Modification du fichier de traitement Cartes Visites (LK)</h4>';
                }else{
                	echo '<h4 class="widget-welcome__message-l1">Ajouter une identité véhicule</h4>';
                }?>
                  
                </div>
                
              </div>
            </div>
            </div>        
          	<div class="main-container">            
            <div class="container-block">
            <div class="row">
            <div class="col-6">            
            <?php
			if(!empty($_POST['doSubmitdata']) && $_POST['doSubmitdata'] == 'download')
			{	
				
				if(isset($_FILES['files']))
				{ 
					$dossier = 'upload/';
					$fichier = basename($_FILES['files']['name']);
					$fichier = strtr($fichier, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					$taille_maxi = 100000000;
					$taille = filesize($_FILES['files']['tmp_name']);
					$extensions = array('.csv');
					$extension = strrchr($_FILES['files']['name'], '.'); 
					if(!in_array($extension, $extensions))
					{
					$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
					<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
					<div class="custom-alert__top-side">
					<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
					<div class="custom-alert__body">
					<h6 class="custom-alert__heading">
					Vous devez uploader un fichier du type csv
					</h6>
					</div>
					</div>          
					</div>';
					}
					if($taille>$taille_maxi)
					{
					$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
					<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
					<div class="custom-alert__top-side">
					<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
					<div class="custom-alert__body">
					<h6 class="custom-alert__heading">
					Le fichier est trop gros
					</h6>
					</div>
					</div>          
					</div>';
					}
					if(file_exists($dossier . $fichier))
					{
					$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
					<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
					<div class="custom-alert__top-side">
					<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
					<div class="custom-alert__body">
					<h6 class="custom-alert__heading">
					Le fichier existe déja sous cette nomination
					</h6>
					</div>
					</div>          
					</div>';
					}
					if(!isset($erreur))
					{
						
						if(move_uploaded_file($_FILES['files']['tmp_name'], $dossier . $fichier))
						{
							 	
								$query = $bdd->prepare("INSERT INTO cat_acide (`nom_cat_acide`, `fichier_cat_acide`, `date_ajout_cat_acide`) VALUES (:nom_cat_acide, :fichier, now())");
								$query->bindParam(":nom_cat_acide", $_POST['doc_name'], PDO::PARAM_STR);
								$query->bindParam(":fichier", $fichier, PDO::PARAM_STR);
								$query->execute();
								$query->closeCursor();
								
								$query = $bdd->prepare("SELECT MAX(id_cat_acide)as max FROM cat_acide");
								$query->execute();
								$donnees_max = $query->fetch();
								$query->closeCursor();
								
								$fichier = fopen($dossier.$fichier, "r");					
																
								$cpt = 1;
								
								if ($fichier !== FALSE) {
									
								while (($data = fgetcsv($fichier, 4096, ";"))) {
									
								$num = count($data);
								
								$cpt++;
								
								for ($c=0; $c < $num; $c++) {
								$col[$c] = $data[$c];
								}						
								
								
								if($col[0] !=''){  
								
								
								$verif = $bdd->prepare("SELECT count(*) FROM acide WHERE id_contact_acide = :id_contact_acide");	
									$verif->bindParam(":id_contact_acide", $col[3], PDO::PARAM_INT);
									//$verif->bindParam(":id_cat_acide", $donnees_max['max'], PDO::PARAM_INT);
									$verif->execute();
									$verif_import = $verif->fetchColumn();
									$verif->closeCursor();
									if($verif_import == 0){
											$query = $bdd->prepare("INSERT INTO acide (id_cat_acide, `raison_sociale_acide`,`code_postal_acide`,`ville_acide`,`id_contact_acide`,`statut_contact_acide`,`civilite_acide`,`nom_acide`,`prenom_acide`,`id_societe_acide`,`fonction_acide`,`url_linkedin_acide`,`new_nom_prenom_acide`,`old_nom_prenom_acide`,`statut_nom_prenom_acide`,`new_poste_acide`,`old_poste_acide`,`statut_poste_acide`,`new_entreprise_acide`,`old_entreprise_acide`,`statut_entreprise_acide`,`new_date_entree_entreprise_acide`,`old_date_entree_entreprise_acide`,`statut_date_entree_entreprise_acide`) VALUES (:id_cat_acide,:raison_sociale_acide,:code_postal_acide,:ville_acide,:id_contact_acide,:statut_contact_acide,:civilite_acide,:nom_acide,:prenom_acide,:id_societe_acide,:fonction_acide,:url_linkedin_acide,:new_nom_prenom_acide,:old_nom_prenom_acide,:statut_nom_prenom_acide,:new_poste_acide,:old_poste_acide,:statut_poste_acide,:new_entreprise_acide,:old_entreprise_acide,:statut_entreprise_acide,:new_date_entree_entreprise_acide,:old_date_entree_entreprise_acide,:statut_date_entree_entreprise_acide)");
											
											$query->bindParam(":id_cat_acide", $donnees_max['max'], PDO::PARAM_INT);
											$query->bindParam(":raison_sociale_acide", utf8_encode($col[0]), PDO::PARAM_STR);
											$query->bindParam(":code_postal_acide", utf8_encode($col[1]), PDO::PARAM_INT);
											$query->bindParam(":ville_acide", utf8_encode($col[2]), PDO::PARAM_STR);
											$query->bindParam(":id_contact_acide", utf8_encode($col[3]), PDO::PARAM_INT);
											$query->bindParam(":statut_contact_acide", utf8_encode($col[4]), PDO::PARAM_STR);
											$query->bindParam(":civilite_acide", utf8_encode($col[5]), PDO::PARAM_STR);
											$query->bindParam(":nom_acide", utf8_encode($col[6]), PDO::PARAM_STR);
											$query->bindParam(":prenom_acide", utf8_encode($col[7]), PDO::PARAM_STR);
											$query->bindParam(":id_societe_acide", utf8_encode($col[8]), PDO::PARAM_INT);
											$query->bindParam(":fonction_acide", utf8_encode($col[9]), PDO::PARAM_STR);
											$query->bindParam(":url_linkedin_acide", utf8_encode($col[10]), PDO::PARAM_STR);
											$query->bindParam(":new_nom_prenom_acide", utf8_encode($col[11]), PDO::PARAM_STR);
											$query->bindParam(":old_nom_prenom_acide", utf8_encode($col[12]), PDO::PARAM_STR);
											$query->bindParam(":statut_nom_prenom_acide", utf8_encode($col[13]), PDO::PARAM_STR);
											$query->bindParam(":new_poste_acide", utf8_encode($col[14]), PDO::PARAM_STR);
											$query->bindParam(":old_poste_acide", utf8_encode($col[15]), PDO::PARAM_STR);
											$query->bindParam(":statut_poste_acide", utf8_encode($col[16]), PDO::PARAM_STR);
											$query->bindParam(":new_entreprise_acide", utf8_encode($col[17]), PDO::PARAM_STR);
											$query->bindParam(":old_entreprise_acide", utf8_encode($col[18]), PDO::PARAM_STR);
											$query->bindParam(":statut_entreprise_acide", utf8_encode($col[19]), PDO::PARAM_STR);
											$query->bindParam(":new_date_entree_entreprise_acide", utf8_encode($col[20]), PDO::PARAM_STR);
											$query->bindParam(":old_date_entree_entreprise_acide", utf8_encode($col[21]), PDO::PARAM_STR);
											$query->bindParam(":statut_date_entree_entreprise_acide", utf8_encode($col[22]), PDO::PARAM_STR);
											$query->execute();
											$query->closeCursor();
									}
								
								}
								
								}
								fclose($fichier);
								}      
				
								echo "<script type='text/javascript'>document.location.replace('Linkedin');</script>";
								
							  
						 } else {
							 
							  echo '<div class="alert custom-alert custom-alert--danger" role="alert">
									<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
									<div class="custom-alert__top-side">
									<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
									<div class="custom-alert__body">
									<h6 class="custom-alert__heading">
									<b> Alerte - </b> Echec de l\'upload !
									</h6>
									</div>
									</div>          
									</div>';
							  
						 }
						 
					}else{
						
						 echo $erreur;
						 
					}
				
				}
			 
			$a = true;	
			}elseif(!empty($_POST['doSubmitdatamodif']) && $_POST['doSubmitdatamodif'] == 'downloadmodif')
			{	
				
				if(isset($_FILES['files']))
				{ 
					$dossier = 'upload/';
					$fichier = basename($_FILES['files']['name']);
					$fichier = strtr($fichier, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					$taille_maxi = 100000000;
					$taille = filesize($_FILES['files']['tmp_name']);
					$extensions = array('.csv');
					$extension = strrchr($_FILES['files']['name'], '.');
					if(!in_array($extension, $extensions))
					{
					$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
					<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
					<div class="custom-alert__top-side">
					<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
					<div class="custom-alert__body">
					<h6 class="custom-alert__heading">
					Vous devez uploader un fichier du type csv
					</h6>
					</div>
					</div>          
					</div>';
					}
					if($taille>$taille_maxi)
					{
					$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
					<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
					<div class="custom-alert__top-side">
					<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
					<div class="custom-alert__body">
					<h6 class="custom-alert__heading">
					Le fichier est trop gros
					</h6>
					</div>
					</div>          
					</div>';
					}
					if(file_exists($dossier . $fichier))
					{
						$erreur = '<div class="alert custom-alert custom-alert--danger" role="alert">
						<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
						<div class="custom-alert__top-side">
						<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
						<div class="custom-alert__body">
						<h6 class="custom-alert__heading">
						Le fichier existe déja sous cette nomination
						</h6>
						</div>
						</div>          
						</div>';
					}
					if(!isset($erreur))
					{
						
						if(move_uploaded_file($_FILES['files']['tmp_name'], $dossier . $fichier))
						{
														
							if(file_exists($dossier . $donnees_update['fichier_cat_acide']))
							{
							$chemin = "upload/".$donnees_update['fichier_cat_acide'];						
							
							unlink($chemin);
							
							}
							
								$query = $bdd->prepare("DELETE FROM acide WHERE id_cat_acide = :id");
								$query->bindParam(":id", $id, PDO::PARAM_INT);
								$query->execute();
								$query->closeCursor();
								
								$query = $bdd->prepare("UPDATE cat_acide SET `nom_cat_acide` = :nom_cat_acide,`fichier_cat_acide` = :fichier_cat_acide,`date_modification_cat_acide` = now() WHERE id_cat_acide = :id");
								$query->bindParam(":id", $id, PDO::PARAM_INT);
								$query->bindParam(":nom_cat_acide", $_POST['doc_name'], PDO::PARAM_STR);
								$query->bindParam(":fichier_cat_acide", $fichier, PDO::PARAM_STR);
								$query->execute();
								$query->closeCursor();							
								
								$fichier = fopen($dossier.$fichier, "r");	
															
								$cpt = 1;							

											if ($fichier !== FALSE) {										
											 
											while (($data = fgetcsv($fichier, 4096, ";"))) {
												
											$num = count($data);
											$cpt++;
											
											for ($c=0; $c < $num; $c++) {
											$col[$c] = $data[$c];
											}
											
											
											
											if($col[0] !=''){ 
											$verif = $bdd->prepare("SELECT count(*) FROM acide WHERE id_contact_acide = :id_contact_acide");	
											$verif->bindParam(":id_contact_acide", $col[3], PDO::PARAM_INT);
											//$verif->bindParam(":id_cat_acide", $donnees_max['max'], PDO::PARAM_INT);
											$verif->execute();
											$verif_import = $verif->fetchColumn();
											$verif->closeCursor();
											if($verif_import == 0){
											
											$query = $bdd->prepare("INSERT INTO acide (id_cat_acide, `raison_sociale_acide`,`code_postal_acide`,`ville_acide`,`id_contact_acide`,`statut_contact_acide`,`civilite_acide`,`nom_acide`,`prenom_acide`,`id_societe_acide`,`fonction_acide`,`url_linkedin_acide`,`new_nom_prenom_acide`,`old_nom_prenom_acide`,`statut_nom_prenom_acide`,`new_poste_acide`,`old_poste_acide`,`statut_poste_acide`,`new_entreprise_acide`,`old_entreprise_acide`,`statut_entreprise_acide`,`new_date_entree_entreprise_acide`,`old_date_entree_entreprise_acide`,`statut_date_entree_entreprise_acide`) VALUES (:id_cat_acide,:raison_sociale_acide,:code_postal_acide,:ville_acide,:id_contact_acide,:statut_contact_acide,:civilite_acide,:nom_acide,:prenom_acide,:id_societe_acide,:fonction_acide,:url_linkedin_acide,:new_nom_prenom_acide,:old_nom_prenom_acide,:statut_nom_prenom_acide,:new_poste_acide,:old_poste_acide,:statut_poste_acide,:new_entreprise_acide,:old_entreprise_acide,:statut_entreprise_acide,:new_date_entree_entreprise_acide,:old_date_entree_entreprise_acide,:statut_date_entree_entreprise_acide)");
								
											$query->bindParam(":id_cat_acide", $id, PDO::PARAM_INT);
											$query->bindParam(":raison_sociale_acide", utf8_encode($col[0]), PDO::PARAM_STR);
											$query->bindParam(":code_postal_acide", utf8_encode($col[1]), PDO::PARAM_INT);
											$query->bindParam(":ville_acide", utf8_encode($col[2]), PDO::PARAM_STR);
											$query->bindParam(":id_contact_acide", utf8_encode($col[3]), PDO::PARAM_INT);
											$query->bindParam(":statut_contact_acide", utf8_encode($col[4]), PDO::PARAM_STR);
											$query->bindParam(":civilite_acide", utf8_encode($col[5]), PDO::PARAM_STR);
											$query->bindParam(":nom_acide", utf8_encode($col[6]), PDO::PARAM_STR);
											$query->bindParam(":prenom_acide", utf8_encode($col[7]), PDO::PARAM_STR);
											$query->bindParam(":id_societe_acide", utf8_encode($col[8]), PDO::PARAM_INT);
											$query->bindParam(":fonction_acide", utf8_encode($col[9]), PDO::PARAM_STR);
											$query->bindParam(":url_linkedin_acide", utf8_encode($col[10]), PDO::PARAM_STR);
											$query->bindParam(":new_nom_prenom_acide", utf8_encode($col[11]), PDO::PARAM_STR);
											$query->bindParam(":old_nom_prenom_acide", utf8_encode($col[12]), PDO::PARAM_STR);
											$query->bindParam(":statut_nom_prenom_acide", utf8_encode($col[13]), PDO::PARAM_STR);
											$query->bindParam(":new_poste_acide", utf8_encode($col[14]), PDO::PARAM_STR);
											$query->bindParam(":old_poste_acide", utf8_encode($col[15]), PDO::PARAM_STR);
											$query->bindParam(":statut_poste_acide", utf8_encode($col[16]), PDO::PARAM_STR);
											$query->bindParam(":new_entreprise_acide", utf8_encode($col[17]), PDO::PARAM_STR);
											$query->bindParam(":old_entreprise_acide", utf8_encode($col[18]), PDO::PARAM_STR);
											$query->bindParam(":statut_entreprise_acide", utf8_encode($col[19]), PDO::PARAM_STR);
											$query->bindParam(":new_date_entree_entreprise_acide", utf8_encode($col[20]), PDO::PARAM_STR);
											$query->bindParam(":old_date_entree_entreprise_acide", utf8_encode($col[21]), PDO::PARAM_STR);
											$query->bindParam(":statut_date_entree_entreprise_acide", utf8_encode($col[22]), PDO::PARAM_STR);
											$query->execute();
											$query->closeCursor();
											}
											
											}
											
											}
											fclose($fichier);
											} 
							        echo "<script type='text/javascript'>document.location.replace('Linkedin');</script>";
							
							  
						 } else {
							 
							  	echo '<div class="alert custom-alert custom-alert--danger" role="alert">
								<!--<span class="close iconfont iconfont-alert-close custom-alert__close" data-dismiss="alert"></span>-->
								<div class="custom-alert__top-side">
								<span class="alert-icon iconfont iconfont-alert-warning custom-alert__icon"></span>
								<div class="custom-alert__body">
								<h6 class="custom-alert__heading">
								<b> Alerte - </b> Echec de l\'upload !
								</h6>
								</div>
								</div>          
								</div>';
							  
						 }
						 
					}else{
						
						 echo $erreur;
						 
					}
				
				}
			 
			$a = true;	
			}
			?>
            <div id="loading_container" style="display : none;">
                <div id="loading_container2">
                    <div id="loading_container3">
                        <div id="loading_container4">
                            Chargement du fichier
                        </div>
                    </div>
                </div>
            </div>
            <div id="formulaire">
            <?php if(!empty($_GET['mode']) && $_GET['mode'] == 'update'){?>
			<form method="post" action="LinkedinAjout-update-<?php echo $id; ?>.html"  enctype="multipart/form-data" onsubmit="afficheLoader('load');">
			<?php }else{ ?>
            <form method="post" action="LinkedinAjout"  enctype="multipart/form-data" onsubmit="afficheLoader('load');">
            <?php } ?>
			<div class="form-group">
          	<label for="read-only">Nom du (fichier / Opération) :</label>
			<input type="text" placeholder="Aucune restriction de taille." class="form-control" name="doc_name" id="doc_name" value="<?php if(!empty($_GET['mode']) && $_GET['mode'] == 'update'){ echo $donnees_update['nom_cat_acide'];}?>" required>
			</div>
            
            
            <?php if(!empty($_GET['mode']) && $_GET['mode'] == 'update'){?>
            <div class="alert custom-alert custom-alert--info" role="alert">
              <div class="custom-alert__top-side">
                <span class="alert-icon iconfont iconfont-alert-info custom-alert__icon"></span>
                <div class="custom-alert__body">
                  <h6 class="custom-alert__heading">
                    Fichier en cours :
                  </h6>
                  <div class="custom-alert__content">
                     <?php
						
								$query = $bdd->prepare("SELECT fichier_cat_acide FROM cat_acide WHERE id_cat_acide = :id");
								$query->bindParam(":id", $id, PDO::PARAM_INT);
								$query->execute();
								$donnees = $query->fetch();								
								$query->closeCursor();
								echo '<b><a target="_blank" href="module/linkedin/upload/'.$donnees['fichier_cat_acide'].'">'.$donnees['fichier_cat_acide'].'</a></b>';
						
					
					?>
                  </div>
                </div>
              </div>
            </div>
            
            <?php }?>  
            <div class="form-group">     
				<label for="read-only">Fichier du type <b>CSV</b> uniquement :</label>
                <input name="files" type="file" required>
			</div>
			<div class="form-group">
            <?php if(!empty($_GET['mode']) && $_GET['mode'] == 'update'){?>
            <button class="btn btn-info icon-right mr-3" name="doSubmitdatamodif" type="submit" id="doSubmitdatamodif" value="downloadmodif" >Modifier le fichier en cours</button>
            <a class="btn btn-danger  mr-3 icon-right" href="Linkedin">Annuler</a>	
            <?php }else{ ?>
            <button class="btn btn-info icon-right mr-3" name="doSubmitdata" type="submit" id="doSubmitdata" value="download" >Importer</button>
            <a class="btn btn-danger  mr-3 icon-right" href="Linkedin">Annuler</a>
            <?php } ?>
			</div>	
			
            </form>
            </div>
			</div>
            <div class="col-3">
            </div>
            <div class="col-3">
            	<img src="img/down/download.png" alt="" class="embed-responsive" />
            </div>
            </div>                                
            </div>
            </div>
                                    
                                    
        </div>
                            </div>
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
		if (file_exists("../../include/".$page) && $page != 'index.php') {
		   include("../../include/".$page); 
		}
	
		else {
			echo "Page inexistante !";
		}
	}
	
	?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../app-assets/vendors/js/jquery.validate.min.js"></script>
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
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script src="../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS
    <script src="../app-assets/js/scripts/datatables/datatable.js"></script>-->
    <!-- END: Page JS-->
    <script charset="utf-8" src="module/identite_vehicule/table/js/webapp_liste_identite_vehicule.js"></script>
    
    
    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/ui/data-list-view.js"></script>
    <script src="../app-assets/js/scripts/extensions/toastr.js"></script>
    <script src="../app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <script src="../app-assets/js/scripts/forms/validation/form-validation.js"></script>
    <!-- END: Page JS-->


</body>
<!-- END: Body-->

</html>