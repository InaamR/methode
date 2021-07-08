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
  
  if (	$job == 'get_liste_sous_chapitre' ||
  		$job == 'get_liste_chapitre' ||
  		$job == 'add_sous_chapitre' ||
		$job == 'get_sous_chapitre_edit' ||
		$job == 'sous_chapitre_edit' ||
		$job == 'del_sous_chapitre'){
		  
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
  
  if ($job == 'get_liste_sous_chapitre'){
	 
	
	
	$PDO_query_sous_chapitre = Bdd::connectBdd()->prepare("SELECT * FROM menu_sous_chapitre ORDER BY menu_sous_chapitre_id ASC");		
	$PDO_query_sous_chapitre->execute();
	
	while ($sous_chapitre = $PDO_query_sous_chapitre->fetch()){	
													
         
		$query = Bdd::connectBdd()->prepare("SELECT menu_chapitre_nom FROM menu_chapitre WHERE menu_chapitre_id = :menu_chapitre_id");
		$query->bindParam(":menu_chapitre_id", $sous_chapitre['menu_chapitre_id'], PDO::PARAM_INT);
		$query->execute();	
		$query_chapitre = $query->fetch();
		$query->closeCursor();		                                                 
                                                        
				
		$functions = '

						
		<td class="product-action">
		
		<center>
		<button type="button" class="btn btn-icon btn-success" id="function_edit_sous_chapitre" data-id="' . $sous_chapitre['menu_sous_chapitre_id'] . '" data-name="' . $sous_chapitre['menu_sous_chapitre_nom'] . '"><i class="feather icon-check-square"></i></button>
		<button type="button" class="btn btn-icon btn-danger rounded-circle" id="confirm-color" data-id="' . $sous_chapitre['menu_sous_chapitre_id'] . '" data-name="' . $sous_chapitre['menu_sous_chapitre_nom'] . '"><i class="feather icon-x-square"></i></button>
		</center>
		
		</td>
		
		';
		
				
		
		
		
		

		$date = date_create($sous_chapitre['menu_sous_chapitre_date']);


		$chapitre_strong = '<b>'.$query_chapitre['menu_chapitre_nom'].'</b>';
			
        $mysql_data[] = array(
			"Sous_chapitre" => $sous_chapitre['menu_sous_chapitre_nom'],
			"Chapitre" => $chapitre_strong,
			"Date_insertion" => date_format($date,"d/m/Y"),
			"bouton" => $functions
        );
	}
	$PDO_query_sous_chapitre->closeCursor();
	$result  = 'success';
	$message = 'Succès de requête';					
	
	$bdd = null;
	$PDO_query_sous_chapitre = null;     
    
}elseif ($job == 'add_sous_chapitre'){   
    		
				
				try 
				{  			
			 
				$query = Bdd::connectBdd()->prepare("INSERT INTO menu_sous_chapitre (`menu_sous_chapitre_nom`,`menu_chapitre_id`,`menu_sous_chapitre_date`)
			 VALUES (:menu_sous_chapitre_nom,:menu_chapitre_id,now())");	
			 	
				$query->bindParam(":menu_sous_chapitre_nom", $_GET['nom_sous_chapitre'], PDO::PARAM_STR);
				$query->bindParam(":menu_chapitre_id", $_GET['nom_chapitre'], PDO::PARAM_INT);	
				
				$query->execute();
				$query->closeCursor();        

				$result  = 'success';
				$message = 'Sous chapitre ajouté avec succés';
						
				       	
                      
                	
		
				}
				catch(PDOException $x) 
				{ 	
					die("Secured");	
					$result  = 'error';
					$message = 'Échec de requête'; 	
				}	
				$query = null;
				$bdd = null;
				
				




}elseif ($job == 'del_sous_chapitre'){
	
	if ($id == ''){
		
		  $result  = 'Échec';
		  $message = 'Échec id';
		  
		} else {
			
			try 
			{		
			$query_del = Bdd::connectBdd()->prepare("DELETE FROM menu_sous_chapitre WHERE menu_sous_chapitre_id = :id");	
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

	}elseif ($job == 'get_sous_chapitre_edit'){
		
		if ($id == ''){
		
		  $result  = 'error';
		  $message = 'Échec id';
		  
		}else{
			
			try 
			{		
				$query_select_add = Bdd::connectBdd()->prepare("SELECT * FROM menu_sous_chapitre WHERE menu_sous_chapitre_id = :id");	
				$query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
				$query_select_add->execute();
				
				while ($traitement_edit = $query_select_add->fetch()){
					
					$mysql_data[] = array(
					"nom_sous_chapitre"  => $traitement_edit['menu_sous_chapitre_nom'],
					"nom_chapitre"  => $traitement_edit['menu_chapitre_id']
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
	
	}elseif ($job == 'sous_chapitre_edit'){
		
		if ($id == ''){
		  $result  = 'Échec';
		  $message = 'Échec id';
		} else {		
			$query = Bdd::connectBdd()->prepare("UPDATE menu_sous_chapitre SET menu_sous_chapitre_nom = :menu_sous_chapitre_nom WHERE menu_sous_chapitre_id = :menu_sous_chapitre_id");
			$query->bindParam(":menu_sous_chapitre_id", $id, PDO::PARAM_INT);
			$query->bindParam(":menu_sous_chapitre_nom", $_GET['nom_sous_chapitre'], PDO::PARAM_STR);
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