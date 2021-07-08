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
  
  if (	$job == 'get_liste_socle' ||
  		$job == 'add_socle' ||
		$job == 'get_socle_edit' ||
		$job == 'socle_edit' ||
		$job == 'del_socle'){
		  
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
  
  if ($job == 'get_liste_socle'){
	 
	
	
	$PDO_query_socle = Bdd::connectBdd()->prepare("SELECT * FROM menu_socle ORDER BY menu_socle_id ASC");		
	$PDO_query_socle->execute();
	
	while ($socle = $PDO_query_socle->fetch()){	
													
                                                          
                                                        
				
		$functions = '

						
						<td class="product-action">
						
						<center>
						<button type="button" class="btn btn-icon btn-success" id="function_edit_socle" data-id="' . $socle['menu_socle_id'] . '" data-name="' . $socle['menu_socle_nom'] . '"><i class="feather icon-check-square"></i></button>
						<button type="button" class="btn btn-icon btn-danger rounded-circle" id="confirm-color" data-id="' . $socle['menu_socle_id'] . '" data-name="' . $socle['menu_socle_nom'] . '"><i class="feather icon-x-square"></i></button>
						</center>
						
						</td>
		
		';
		//$functions .= '<a href="#" id="del" data-id="' . $user['id'] . '" data-name="' . $user['full_name'] . '"  data-doc="' . $user['full_name'] . '"><span  class="badge badge-bittersweet mb-3 mr-3">Effacer</span></a>';
			
		
		
		$date = date_create($socle['menu_socle_date']);
			
        $mysql_data[] = array(
			"Socle" => $socle['menu_socle_nom'],
			"Date_insertion" => date_format($date,"d/m/Y"),
			"bouton" => $functions
        );
	}
	$PDO_query_socle->closeCursor();
	$result  = 'success';
	$message = 'Succès de requête';					
	
	$bdd = null;
	$PDO_query_socle = null;     
    
}elseif ($job == 'add_socle'){   
    		
				try 
				{  			
			 
				$query = Bdd::connectBdd()->prepare("INSERT INTO menu_socle (`menu_socle_nom`,`menu_socle_date`)
			 VALUES (:menu_socle_nom,now())");	
			 	
				$query->bindParam(":menu_socle_nom", $_GET['nom_socle'], PDO::PARAM_STR);
				
				$query->execute();
				$query->closeCursor();        

				$result  = 'success';
				$message = 'Socle ajouté avec succés';
						
				       	
                      
                	
		
				}
				catch(PDOException $x) 
				{ 	
					die("Secured");	
					$result  = 'error';
					$message = 'Échec de requête'; 	
				}	
				$query = null;
				$bdd = null;
				


}

















elseif ($job == 'del_socle'){

	if ($id == ''){
		
		  $result  = 'Échec';
		  $message = 'Échec id';
		  
		} else {
			
			try 
			{		
			$query_del = Bdd::connectBdd()->prepare("DELETE FROM menu_socle WHERE menu_socle_id = :id");	
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

	}elseif ($job == 'get_socle_edit'){
		
		if ($id == ''){
		
		  $result  = 'error';
		  $message = 'Échec id';
		  
		}else{
			
			try 
			{		
				$query_select_add = Bdd::connectBdd()->prepare("SELECT * FROM menu_socle WHERE menu_socle_id = :id");	
				$query_select_add->bindParam(":id", $id, PDO::PARAM_INT);
				$query_select_add->execute();
				
				while ($traitement_edit = $query_select_add->fetch()){
					
					$mysql_data[] = array(
					"nom_socle"  => $traitement_edit['menu_socle_nom'],
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
	
	}elseif ($job == 'socle_edit'){
		
		if ($id == ''){
		  $result  = 'Échec';
		  $message = 'Échec id';
		} else {		
			$query = Bdd::connectBdd()->prepare("UPDATE menu_socle SET menu_socle_nom = :menu_socle_nom WHERE menu_socle_id = :menu_socle_id");
			$query->bindParam(":menu_socle_id", $id, PDO::PARAM_INT);
			$query->bindParam(":menu_socle_nom", $_GET['nom_socle'], PDO::PARAM_STR);
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