<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        
        
        
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
                <li class=" nav-item"><a href="TableadeBord"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Tableau de bord</span></a></li>
                
                <li class=" navigation-header"><span>ADMINISTRATION</span></li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Admin</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeUsers"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
               
                
                     <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">Equipe</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeEquipe"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                
                
                <li class=" nav-item"><a href="#"><i class="fa fa-level-up"></i><span class="menu-title" data-i18n="User">Niveau</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeNiveau"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>

                <li class=" navigation-header"><span>SERVICES</span></li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-corner-down-right"></i><span class="menu-title" data-i18n="User">Socle</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeSocle"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Chapitre</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeChapitre"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Sous chapitre</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeSousChapitre"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Identité véhicule</span></a>
                    <ul class="menu-content">
                        <li><a href="ListeIdentiteVehicule"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Liste</span></a>
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
                $query = $bdd->prepare("SELECT * FROM user_equipe_methode WHERE equipe_menu = 1");
                $query->execute();
                while ($query_equipe = $query->fetch()){
                
                  echo '<li class=" navigation-header"><span>'.$query_equipe['equipe_name'].'</span></li>';
                }
                $query->closeCursor();
                ?> 
                
                
                
                
                
                
            </ul>
        </div>
    </div>