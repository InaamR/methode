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