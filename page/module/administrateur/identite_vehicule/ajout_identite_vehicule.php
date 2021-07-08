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

<?php
			if(!empty($_POST['upload_submit']) && $_POST['upload_submit'] == 'upload_submit')
			/*if(!empty($_POST['NAME_SUBMIT']) && $_POST['NAME_SUBMIT'] == 'VALUE_SUBMIT')*/
			
			{	
				
				if(isset($_FILES['file_upload']))
				/*if(isset($_FILES['NAME_BTN_FILE']))*/
				{ 
					$dossier = 'upload/';
					$fichier = basename($_FILES['file_upload']['name']);
					$fichier = strtr($fichier, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					$taille_maxi = 100000000;
					$taille = filesize($_FILES['file_upload']['tmp_name']);
					$extensions = array('.csv');
					$extension = strrchr($_FILES['file_upload']['name'], '.'); 
					if(!in_array($extension, $extensions))
					/*l'extension demandée n'existe pas(.csv)*/
					{
					$erreur = 'Vous devez importer un fichier du type csv';
					}
					if($taille>$taille_maxi)
					{
					$erreur = 'La taille du fichier est trop grande';
					}
					if(file_exists($dossier . $fichier))
					{
					$erreur = 'Un fichier avec le même nom existe déjà';
					}
					
					if(!isset($erreur))
                    {
						if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $dossier . $fichier))
						{
							$fichier = fopen($dossier.$fichier, "r");					
																
								$cpt = 1;
								
                                if ($fichier !== FALSE)
                                {
									
                                    while (($data = fgetcsv($fichier, 4096, ";")))
                                    {
                                        
                                        $num = count($data);
                                        
                                        $cpt++;
                                        
                                        for ($c=0; $c < $num; $c++) {
                                        $col[$c] = $data[$c];
                                        }						
                                    
                                        if($col[1] !=''){
                                            $query = $bdd->prepare("INSERT INTO ident_vehicule (`ident_vehicule_CGMOD_P`,`ident_vehicule_CODGRPVER`,`ident_vehicule_MARQUE`,`ident_vehicule_GAMME`,`ident_vehicule_CODGRPMOD`,`ident_vehicule_DATDEB_GRPMOD`,`ident_vehicule_DATFIN_GRPMOD`,`ident_vehicule_GMOD_P`,`ident_vehicule_DATE_DEB_GMOD_P`,`ident_vehicule_DATE_FIN_GMOD_P`,`ident_vehicule_COMPLEMENTGAMME`,`ident_vehicule_NUMEROSERIE`,`ident_vehicule_PHASE`,`ident_vehicule_MODELE`,`ident_vehicule_ID_MOD`,`ident_vehicule_NOMMODAFF`,`ident_vehicule_NOMGRPVER`,`ident_vehicule_VARIANTEDATEDEBUT`,`ident_vehicule_VARIANTEDATEFIN`,`ident_vehicule_VERSIONSPECIFIQUE`,`ident_vehicule_NOMBREPORTES`,`ident_vehicule_CFGPTE`,`ident_vehicule_FORMECARROSSERIE`,`ident_vehicule_GENREVEHICULE`,`ident_vehicule_CARROSSERIECOMMERCIALE`,`ident_vehicule_TYPEEMPATTEMENT`,`ident_vehicule_HAUTEUR`,`ident_vehicule_CHARGE`,`ident_vehicule_TYPEMOTEUR`,`ident_vehicule_INDICEMOTEUR`,`ident_vehicule_CYLINDREELITRES`,`ident_vehicule_CYLINDREECC`,`ident_vehicule_ENERGIE`,`ident_vehicule_TYPEALIMENTATION`,`ident_vehicule_INJECTIONCOMMERCIALE`,`ident_vehicule_SURALIMENTATION`,`ident_vehicule_FILTREAPARTICULES`,`ident_vehicule_AVECCATALYSEUR`,`ident_vehicule_DEPOLLUTION`,`ident_vehicule_CONFIGURATIONMOTEUR`,`ident_vehicule_NOMBRECYLINDRES`,`ident_vehicule_NOMBRESOUPAPES`,`ident_vehicule_ARBREACAME`,`ident_vehicule_PUISSANCE`,`ident_vehicule_PUISSANCEFISCALE`,`ident_vehicule_TYPEDISTRIBUTION`,`ident_vehicule_ENTRAINEMENTDISTRIBUTION`,`ident_vehicule_CONSTMOT`,`ident_vehicule_MOTEURCOMMERCIAL`,`ident_vehicule_GENREBOITE`,`ident_vehicule_NOMBRERAPPORTS`,`ident_vehicule_TYPEBOITE`,`ident_vehicule_ESSIEUMOTEUR`,`ident_vehicule_TYPEFREINAVANT`,`ident_vehicule_TYPEFREINARRIERE`,`ident_vehicule_TONNAGE`,`ident_vehicule_TYPSUSP`,`ident_vehicule_COTECONDUCTEUR`,`ident_vehicule_TYPEMINES`,`ident_vehicule_TAPV`,`ident_vehicule_date`) VALUES (:ident_vehicule_CGMOD_P,:ident_vehicule_CODGRPVER,:ident_vehicule_MARQUE,:ident_vehicule_GAMME,:ident_vehicule_CODGRPMOD,:ident_vehicule_DATDEB_GRPMOD,:ident_vehicule_DATFIN_GRPMOD,:ident_vehicule_GMOD_P,:ident_vehicule_DATE_DEB_GMOD_P,:ident_vehicule_DATE_FIN_GMOD_P,:ident_vehicule_COMPLEMENTGAMME,:ident_vehicule_NUMEROSERIE,:ident_vehicule_PHASE,:ident_vehicule_MODELE,:ident_vehicule_ID_MOD,:ident_vehicule_NOMMODAFF,:ident_vehicule_NOMGRPVER,:ident_vehicule_VARIANTEDATEDEBUT,:ident_vehicule_VARIANTEDATEFIN,:ident_vehicule_VERSIONSPECIFIQUE,:ident_vehicule_NOMBREPORTES,:ident_vehicule_CFGPTE,:ident_vehicule_FORMECARROSSERIE,:ident_vehicule_GENREVEHICULE,:ident_vehicule_CARROSSERIECOMMERCIALE,:ident_vehicule_TYPEEMPATTEMENT,:ident_vehicule_HAUTEUR,:ident_vehicule_CHARGE,:ident_vehicule_TYPEMOTEUR,:ident_vehicule_INDICEMOTEUR,:ident_vehicule_CYLINDREELITRES,:ident_vehicule_CYLINDREECC,:ident_vehicule_ENERGIE,:ident_vehicule_TYPEALIMENTATION,:ident_vehicule_INJECTIONCOMMERCIALE,:ident_vehicule_SURALIMENTATION,:ident_vehicule_FILTREAPARTICULES,:ident_vehicule_AVECCATALYSEUR,:ident_vehicule_DEPOLLUTION,:ident_vehicule_CONFIGURATIONMOTEUR,:ident_vehicule_NOMBRECYLINDRES,:ident_vehicule_NOMBRESOUPAPES,:ident_vehicule_ARBREACAME,:ident_vehicule_PUISSANCE,:ident_vehicule_PUISSANCEFISCALE,:ident_vehicule_TYPEDISTRIBUTION,:ident_vehicule_ENTRAINEMENTDISTRIBUTION,:ident_vehicule_CONSTMOT,:ident_vehicule_MOTEURCOMMERCIAL,:ident_vehicule_GENREBOITE,:ident_vehicule_NOMBRERAPPORTS,:ident_vehicule_TYPEBOITE,:ident_vehicule_ESSIEUMOTEUR,:ident_vehicule_TYPEFREINAVANT,:ident_vehicule_TYPEFREINARRIERE,:ident_vehicule_TONNAGE,:ident_vehicule_TYPSUSP,:ident_vehicule_COTECONDUCTEUR,:ident_vehicule_TYPEMINES,:ident_vehicule_TAPV,:ident_vehicule_date)");
                                            
                                                /*$query->bindParam(":ident_vehicule_id", $donnees_max['max'], PDO::PARAM_INT);*/
                                                $query->bindParam(":ident_vehicule_CGMOD_P", utf8_encode($col[0]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_CODGRPVER", utf8_encode($col[1]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_MARQUE", utf8_encode($col[2]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_GAMME", utf8_encode($col[3]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CODGRPMOD", utf8_encode($col[4]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_DATDEB_GRPMOD", utf8_encode($col[5]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_DATFIN_GRPMOD", utf8_encode($col[6]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_GMOD_P", utf8_encode($col[7]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_DATE_DEB_GMOD_P", utf8_encode($col[8]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_DATE_FIN_GMOD_P", utf8_encode($col[9]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_COMPLEMENTGAMME", utf8_encode($col[10]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_NUMEROSERIE", utf8_encode($col[11]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_PHASE", utf8_encode($col[12]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_MODELE", utf8_encode($col[13]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_ID_MOD", utf8_encode($col[14]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_NOMMODAFF", utf8_encode($col[15]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_NOMGRPVER", utf8_encode($col[16]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_VARIANTEDATEDEBUT", utf8_encode($col[17]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_VARIANTEDATEFIN", utf8_encode($col[18]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_VERSIONSPECIFIQUE", utf8_encode($col[19]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_NOMBREPORTES", utf8_encode($col[20]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_CFGPTE", utf8_encode($col[21]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_FORMECARROSSERIE", utf8_encode($col[22]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_GENREVEHICULE", utf8_encode($col[23]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CARROSSERIECOMMERCIALE", utf8_encode($col[24]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEEMPATTEMENT", utf8_encode($col[25]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_HAUTEUR", utf8_encode($col[26]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CHARGE", utf8_encode($col[27]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEMOTEUR", utf8_encode($col[28]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_INDICEMOTEUR", utf8_encode($col[29]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CYLINDREELITRES", utf8_encode($col[30]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_CYLINDREECC", utf8_encode($col[31]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_ENERGIE", utf8_encode($col[32]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEALIMENTATION", utf8_encode($col[33]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_INJECTIONCOMMERCIALE", utf8_encode($col[34]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_SURALIMENTATION", utf8_encode($col[35]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_FILTREAPARTICULES", utf8_encode($col[36]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_AVECCATALYSEUR", utf8_encode($col[37]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_DEPOLLUTION", utf8_encode($col[38]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CONFIGURATIONMOTEUR", utf8_encode($col[39]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_NOMBRECYLINDRES", utf8_encode($col[40]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_NOMBRESOUPAPES", utf8_encode($col[41]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_ARBREACAME", utf8_encode($col[42]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_PUISSANCE", utf8_encode($col[43]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_PUISSANCEFISCALE", utf8_encode($col[44]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_TYPEDISTRIBUTION", utf8_encode($col[45]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_ENTRAINEMENTDISTRIBUTION", utf8_encode($col[46]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_CONSTMOT", utf8_encode($col[47]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_MOTEURCOMMERCIAL", utf8_encode($col[48]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_GENREBOITE", utf8_encode($col[49]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_NOMBRERAPPORTS", utf8_encode($col[50]), PDO::PARAM_INT);
                                                $query->bindParam(":ident_vehicule_TYPEBOITE", utf8_encode($col[51]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_ESSIEUMOTEUR", utf8_encode($col[52]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEFREINAVANT", utf8_encode($col[53]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEFREINARRIERE", utf8_encode($col[54]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TONNAGE", utf8_encode($col[55]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPSUSP", utf8_encode($col[56]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_COTECONDUCTEUR", utf8_encode($col[57]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TYPEMINES", utf8_encode($col[58]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_TAPV", utf8_encode($col[59]), PDO::PARAM_STR);
                                                $query->bindParam(":ident_vehicule_date", utf8_encode($col[60]), PDO::PARAM_STR);                                            
                                                $query->execute();
                                                $query->closeCursor();
                                        }
                                    
                                    }
								    fclose($fichier);
						        }
						
						        echo "<script type='text/javascript'>document.location.replace('ListeIdentiteVehicule');</script>";
						
                        }else{
                        
                        echo 'Echec du téléchargement !';
                        
                        }
                            
                            
                            
                    }else{
                            
                        echo $erreur;
                    }
			    }
					
				$a = true;	
            }

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
                                    <li class="breadcrumb-item"><a href="#">Chargement d'un nouveau fichier Excel des identités véhicules</a>
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
                    
				   <!-- add new form starts -->
     				            
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <!-- basic buttons -->
                                                  <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                        
                                        	<div class="col-xl-12 col-md-6 col-12 mb-3">
                                                <h5>Chargement d'un nouveau fichier Excel des identités véhicules</h5>
                                            </div>
                                            
                                        	<form method="post" action="AjouterIdentiteVehicule" enctype="multipart/form-data" class="col-12">
                                            
                                            
                                            <div class="col-xl-12 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Nom du fichier*</label>
                                                    <input type="text" class="form-control" id="basicInput" placeholder="Nom du fichier" name="nom_fichier">
                                                </fieldset>
                                            </div>
                                        
                                            <div class="col-xl-12 col-md-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <label for="basicInput">Charger un nouveau fichier</label>
                                                    <input type="file" class="form-control" id="basicInput" name="file_upload">
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-xl-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <button type="submit" class="btn btn-success mr-1 mb-1 action-edit col-xl-12 col-md-6 col-12" id="upload_submit" name="upload_submit" value="upload_submit" tabindex="0" aria-controls="DataTables_Table_0">Importer</button>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-xl-6 col-12 mb-1">
                                                <fieldset class="form-group">
                                                    <button type="button" class="btn btn-danger mr-1 mb-1 action-edit col-xl-12 col-md-6 col-12" tabindex="0" aria-controls="DataTables_Table_0">Annuler</button>
                                                </fieldset>
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
                           </div>
                  	</div>  
                    
                     

                   <!-- add new form ends -->
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