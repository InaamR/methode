<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/index.php">
                    <span class="brand-logo">
                        <img src="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/app-assets/images/logo/favicon-48x48.png" alt="petit-logo" class="">
                    </span>
                    <span class="brand-logo-big">
                        <img src="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/app-assets/images/logo/logo_cube.png" alt="">
                    </span>
                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>

        </ul>

    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            <li class=" nav-item">
                <a class="nav-lik d-flex" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/index.php">
                    <i class="bi bi-house"></i>
                    <span class="menu-title text-truncate" data-i18n="Accueil">Accueil</span>
                </a>
            </li>
            <li class=" navigation-header"><span data-i18n="Section Direction">Gestion des services</span><i data-feather="more-horizontal"></i></li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="bi bi-people"></i>
                    <span class="menu-title text-truncate" data-i18n="Com. Générale" id="communication">Services</span>
                </a>
                <ul class="menu-content">
                       
                        <?php                        
                            if($file == 'liste_equipe.php'){
                                
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/equipe/liste_equipe.php">
                            <i class="bi bi-record2"></i>
                            <span class="menu-item text-truncate" data-i18n="Archive">Équipes</span>
                        </a>
                    </li>

                        <?php                        
                            if($file == 'liste_niveau.php'){                                
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/niveau/liste_niveau.php">
                            <i class="bi bi-record2"></i>
                            <span class="menu-item text-truncate" data-i18n="Archive">Gestion des droits</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="Gestion des planning">Gestion de la Production</span><i data-feather="more-horizontal"></i></li>

            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <i class="bi bi-ui-radios"></i>
                <span class="menu-title text-truncate" data-i18n="Options planning">Gestion des Niveaux</span></a>
                <ul class="menu-content">

                    <?php                        
                            if($file == 'liste_socle.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/socle/liste_socle.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Socles">Socles</span></a>
                    </li>

                    <?php                        
                            if($file == 'liste_chapitre.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/chapitre/liste_chapitre.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Chapitres">Chapitres</span></a>
                    </li>

                    <?php                        
                            if($file == 'liste_sous_chapitre.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/sous_chapitre/liste_sous_chapitre.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Sous chapitres">Sous chapitres</span></a>
                    </li>

                    <?php   

                            if($file == 'liste_idv.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/identite_vehicule/liste_idv.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Identités véhicules">Base Ident</span></a>
                    </li>

                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <i class="bi bi-calendar-plus"></i>
                <span class="menu-title text-truncate" data-i18n="Planning">Planning</span></a>
                <ul class="menu-content">

                    <?php                        
                            if($file == 'liste_planning.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/etude/liste_planning.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Etudes">Etudes</span></a>
                    </li>

                    <?php                        
                            if($file == 'liste_avancement.php'){                            
                                echo'<li class="active">';
                            }else{
                                echo'<li class="">';
                            }
                        ?>
                    
                        <a class="d-flex align-items-center" href="http://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/avancement/liste_avancement.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Avancements">Affectation</span></a>
                    </li>
                    
                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="DSI">Statistiques</span><i data-feather="more-horizontal"></i></li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="bi bi-clipboard-data"></i>
                    <span class="menu-title text-truncate" data-i18n="Pages" id="Dir. des Systèmes d'information">Reporting</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i class="bi bi-record2"></i>
                            <span class="menu-item text-truncate" data-i18n="">Excel</span>
                        </a>
                    </li>                   
                </ul>
            </li>
            
            <li class=" navigation-header"><span data-i18n="">Administration</span><i data-feather="more-horizontal"></i></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#">
                <i class="bi bi-sliders"></i>
                <span class="menu-title text-truncate" data-i18n="Admin">Admin</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" title="Gestion du personnel" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/admin/listeMembre.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="G.Personnel">G.Personnel</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" title="Type d'activation" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/admin/activation.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Type d'activation">Type d'activation</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" title="Liste des connexions" href="https://<?php echo $_SERVER['SERVER_NAME']?>/<?php echo $PARAM_url_non_doc_site; ?>/page/module/administrateur/admin/listeJeton.php"><i class="bi bi-record2"></i><span class="menu-item text-truncate" data-i18n="Liste des connexions">Liste des connexions</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>