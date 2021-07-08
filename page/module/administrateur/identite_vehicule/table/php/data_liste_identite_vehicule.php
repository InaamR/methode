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
$id  = '';
$st = '';

if (isset($_GET['job'])){
  $job = $_GET['job'];
  
  if (	$job == 'get_liste_identite_vehicule' ||
  		$job == 'add_identite' ||
		$job == 'get_niveau_edit' ||
		$job == 'niveau_edit' ||
		$job == 'del_niveau' ||
		$job == 'get_modal_data'){
			
		if (isset($_GET['id'])){
		  $id = $_GET['id'];
		  if (!is_numeric($id)){
			$id = '';
		  }
		}
		
		if (isset($_GET['st'])){
		  $st = $_GET['st'];
		  if (!is_numeric($st)){
			$st = '';
		  }
		}
		
		if (isset($_GET['mdp'])){
		  $mdp = $_GET['mdp'];
		  if (!is_numeric($mdp)){
			$mdp = '';
		  }
		}
		
		
  } else {
    $job = '';
  }
}

$mysql_data = array();

if ($job != ''){  
  
  if ($job == 'get_liste_identite_vehicule'){
	 
	
	
	$PDO_query_identite_vehicule = Bdd::connectBdd()->prepare("SELECT * FROM ident_vehicule ORDER BY ident_vehicule_id ASC");		
	$PDO_query_identite_vehicule->execute();
	
	while ($identite_vehicule = $PDO_query_identite_vehicule->fetch()){	
													
                                                          
                               		$functions = ' 
					
						<center>
						<button type="button" class="btn btn-icon btn-success mr-1 mb-1" id="function_edit_identite_vehicule" data-id="' . $identite_vehicule['ident_vehicule_id'] . '" data-name="' . $identite_vehicule['ident_vehicule_MARQUE'] . '"><i class="feather icon-check-square"></i></button>
						<button type="button" class="btn btn-icon btn-danger mr-1 mb-1" id="confirm-color" data-id="' . $identite_vehicule['ident_vehicule_id'] . '" data-name="' . $identite_vehicule['ident_vehicule_MARQUE'] . '"><i class="feather icon-x-square"></i></button>
						</center>
						
		
		';	
		                         	
		
				
		$functions_1 = '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalScrollable" id="function_afficher_info" data-id="' . $identite_vehicule['ident_vehicule_id'] . '">
		Afficher tous les critères
		</button>';	
		

		
			
        $mysql_data[] = array(
			"CGMOD_P" => $identite_vehicule['ident_vehicule_CGMOD_P'],
			"CODGRPVER" => $identite_vehicule['ident_vehicule_CODGRPVER'],
			"MARQUE" => $identite_vehicule['ident_vehicule_MARQUE'],
			"GAMME" => $identite_vehicule['ident_vehicule_GAMME'],
			"CODGRPMOD" => $identite_vehicule['ident_vehicule_CODGRPMOD'],
			"DATDEB_GRPMOD" => $identite_vehicule['ident_vehicule_DATDEB_GRPMOD'],
			"DATFIN_GRPMOD" => $identite_vehicule['ident_vehicule_DATFIN_GRPMOD'],
			"GMOD_P" => $identite_vehicule['ident_vehicule_GMOD_P'],
			"bouton_1" => $functions_1,
			"bouton" => $functions
        );
	}
	$PDO_query_identite_vehicule->closeCursor();
	$result  = 'success';
	$message = 'Succès de requête';					
	
	$bdd = null;
	$PDO_query_identite_vehicule = null;     
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
}elseif ($job == 'add_identite'){   
    		
				try 
				{  			
			 
				$query = Bdd::connectBdd()->prepare("INSERT INTO ident_vehicule (`ident_vehicule_CGMOD_P`,`ident_vehicule_date`)
			 VALUES (:ident_vehicule_CGMOD_P,:ident_vehicule_GAMME,now())");	
			 	
				$query->bindParam(":ident_vehicule_CGMOD_P", $_GET['cgmod_p_identite'], PDO::PARAM_STR);
				
				$query->execute();
				$query->closeCursor();        

				$result  = 'success';
				$message = 'Identité véhicule ajoutée avec succés';
						
				}
				catch(PDOException $x) 
				{ 	
					die("Secured");	
					$result  = 'error';
					$message = 'Échec de requête'; 	
				}	
				$query = null;
				$bdd = null;
				
				
				
				
				
				
				
				
	


}elseif ($job == 'get_modal_data'){
    
    if ($id == ''){
        
      $result  = 'error';
      $message = 'Échec id';
      
    } else {
        
        try 
        {
        $query_select_add = Bdd::connectBdd()->prepare("SELECT * FROM ident_vehicule WHERE ident_vehicule_id = :id");   
        $query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
        $query_select_add->execute();       
        $traitement_edit = $query_select_add->fetch();
            
 
        $mysql_data[] = array(  
			"cgmod_p"  => $traitement_edit['ident_vehicule_CGMOD_P'],
			"codgrpver"  => $traitement_edit['ident_vehicule_CODGRPVER'],
			"marque"  => $traitement_edit['ident_vehicule_MARQUE'],
			"gamme"  => $traitement_edit['ident_vehicule_GAMME'],
			"codgrpmod"  => $traitement_edit['ident_vehicule_CODGRPMOD'],
			"datdeb_grpmod"  => $traitement_edit['ident_vehicule_DATDEB_GRPMOD'],
			"datfin_grpmod"  => $traitement_edit['ident_vehicule_CGMOD_P'],
			"gmod_p"  => $traitement_edit['ident_vehicule_CGMOD_P'],
			"date_deb_gmod_p"  => $traitement_edit['ident_vehicule_DATE_DEB_GMOD_P'],
			"date_fin_gmod_p"  => $traitement_edit['ident_vehicule_DATE_FIN_GMOD_P']
        );
        
        
        $query_select_add->closeCursor();       
        $result  = 'success';
        $message = 'Succès de requête';
        }
        catch(PDOException $x) 
        {   
            die("Secured"); 
            $result  = 'error';
            $message = 'Échec de requête';  
        }   
        $query_del = null;
        $bdd = null;
      
    }
 
}elseif ($job == 'del_niveau'){
	
	if ($id == ''){
		
		  $result  = 'Échec';
		  $message = 'Échec id';
		  
				} else {
					
							try 
							{		
							$query_del = Bdd::connectBdd()->prepare("DELETE FROM user_niveau WHERE niveau_id = :id");	
							$query_del->bindParam(":id", $id, PDO::PARAM_INT);
							$query_del->execute();
							$query_del->closeCursor();	
							$result  = 'success';
							$message = 'Succès de requête';	
							}
								catch(PDOException $x) 
								{ 	
								die("Secured");	
								$result  = 'error';
								$message = 'Échec de requête'; 	
								}	
					$query_del = null;
					$bdd = null;
					
				  
				}


















	}elseif ($job == 'get_niveau_edit'){
		
		if ($id == ''){
		
		  $result  = 'error';
		  $message = 'Échec id';
		  
		}else{
			
			try 
			{		
				$query_select_add = Bdd::connectBdd()->prepare("SELECT * FROM user_niveau WHERE niveau_id = :id");	
				$query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
				$query_select_add->execute();
				
				while ($traitement_edit = $query_select_add->fetch()){
					
					$mysql_data[] = array(
					"nom_niveau"  => $traitement_edit['niveau_name'],
				  );	
						}
						
						$query_select_add->closeCursor();
						
						$result  = 'success';
						$message = 'Succès de requête';
					
					}
			catch(PDOException $x) 
						{ 	
							die("Secured");	
							$result  = 'error';
							$message = 'Échec de requête'; 	
						}	
			$query_del = null;
			$bdd = null;
		}
		
		
		
	
	}elseif ($job == 'niveau_edit'){
		
		if ($id == ''){
		  $result  = 'Échec';
		  $message = 'Échec id';
		} else {		
			$query = Bdd::connectBdd()->prepare("UPDATE user_niveau SET niveau_name = :niveau_name WHERE niveau_id = :niveau_id");
			$query->bindParam(":niveau_id", $id, PDO::PARAM_INT);
			$query->bindParam(":niveau_name", $_GET['nom_niveau'], PDO::PARAM_STR);
			$query->execute();
			$query->closeCursor();
			$result  = 'success';
			$message = 'Succès de requête';
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