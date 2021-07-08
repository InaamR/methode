<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        
        
        
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
                <li class=" nav-item"><a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Tableau de bord</span></a></li>
                
                <li class=" navigation-header"><span>ADMINISTRATION</span></li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="User">Messagerie</span></a>
                    <ul class="menu-content">                      
                        
                        <li><a href="<?php echo Admin::menuadmin();?>messagerie.php"><i class="feather icon-message-square"></i><span class="menu-item" data-i18n="List">Messagerie</span></a>
                        </li>                       

                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Membres/Activa.</span></a>
                    <ul class="menu-content">                        
                        
                        <li><a href="<?php echo Admin::menuadmin();?>listeMembre.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste / Roles</span></a>
                        </li>
                        <li><a href="<?php echo Admin::menuadmin();?>activation.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Activation</span></a>
                        </li>

                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><i class="feather icon-user-plus"></i><span class="menu-title" data-i18n="User">Profil.</span></a>
                    <ul class="menu-content">
                
                        <li><a href="<?php echo Admin::menuadmin();?>profil.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Profil</span></a>
                        </li>
                        <li><a href="<?php echo Admin::menuadmin();?>aide.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Aide</span></a>
                        </li>
                    </ul>
                </li>

                

                <li class=" navigation-header"><span>SERVICES</span></li>

                <li class=" nav-item"><a href="#"><i class="feather icon-globe"></i><span class="menu-title" data-i18n="User">Équipe</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menuequipe();?>liste_equipe.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Gestion</span></a>
                        </li>
                    </ul>
                </li>
                
                
                
                <li class=" nav-item"><a href="#"><i class="fa fa-level-up"></i><span class="menu-title" data-i18n="User">Niveau</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menuniveau();?>liste_niveau.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-corner-down-right"></i><span class="menu-title" data-i18n="User">Socle</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menusocle();?>liste_socle.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Chapitre</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menuchapitre();?>liste_chapitre.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Sous chapitre</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menusouschapitre();?>liste_sous_chapitre.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Identité véhicule</span></a>
                    <ul class="menu-content">
                        <li><a href="<?php echo Admin::menuidv();?>liste_identite_vehicule.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="User">Planning</span></a>
                    <ul class="menu-content">
                        <li><a href="ListePlanning"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
				<?php
                /*$query = $bdd->prepare("SELECT * FROM user_equipe_methode WHERE equipe_menu = 1");
                $query->execute();
                while ($query_equipe = $query->fetch()){
                
                  echo '<li class=" navigation-header"><span>'.$query_equipe['equipe_name'].'</span></li>';
                }
                $query->closeCursor();*/
                ?> 
                
                
                
                
                
                
            </ul>
        </div>
    </div>