<?php
include('config.php');
// variables de connexion
define('DNS', 'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd.'; charset=utf8');
define('USER', $PARAM_utilisateur);
define('PASS', $PARAM_mot_passe);
// base site
define('NOMSITE', $PARAM_nom_site);
define('MAILSITE', $PARAM_mail_site);
define('URLSITE', $PARAM_url_site);
// base sql
define('SELECT', 'SELECT ');
define('UPDATE', 'UPDATE ');
define('INSERT', 'INSERT INTO ');
define('DELETE', 'DELETE ');
define('ALL', '*');
// les tables
define('MEMBRE', ' FROM methode_membres');
define('JETON', ' FROM methode_secure');
define('ACTIVATION', ' FROM methode_activation');
define('JETONMAIL', ' FROM methode_activationMail');
define('MESSAGE', ' FROM methode_messagerie');
define('SMILEY', ' FROM methode_smiley');
define('ACCESPROFIL', ' FROM methode_accesfiches');
define('AVATAR', ' FROM methode_avatar');
// les tables sans FROM
define('MEMBREZ', 'methode_membres');
define('JETONZ', 'methode_secure');
define('ACTIVATIONZ', 'methode_activation');
define('JETONMAILZ', 'methode_activationMail');
define('MESSAGEZ', 'methode_messagerie');
define('ACCESPROFILZ', 'methode_accesfiches');
// les variables de recherche sur la table membres
define('ID', ' WHERE id=:id');
define('NOI', ' WHERE id!=:id');
define('NOID', ' WHERE id!=:id ORDER BY pseudo ASC');
define('PSEUDO', ' WHERE pseudo=:identifiant');
define('EMAIL', ' WHERE email=:email');
define('PROFIL', ' (pseudo, email, password) VALUES (:pseudo, :email, :pass)');
define('IDMEMBRE', ' WHERE id_membre=:id');
define('LOGIN', ' WHERE pseudo=:login');
define('ACTIVMEMBRE', ' SET activation=:activer');
define('MAJPROFIL', ' SET email=:email, tel=:tel, adresse=:adresse, cp=:cp, ville=:ville, genre=:genre, naissance=:naissance, nom=:nom, prenom=:prenom, description=:description, mailing=:mailing WHERE id=:id');
define('MAJAVATAR', ' SET id_avatar=:idAvatar');
define('MAJPASS', ' SET password=:newPass');
define('NIVEAU', ' SET niveau=:niveau');
define('DESIGN', ' SET design=:design');
// les variables de recherche sur la table methode d'activation
define('METHODEACTIV', ' WHERE activation=1');
define('CHANGEMETOD', ' SET activation=:activ');
// les variables de recherche sur la table jeton de connexion
define('JETONCONNEXION', ' WHERE id_membre=:id AND ip_connexion=:ip');
define('JETONSESSION', ' WHERE id_membre=:id AND jeton=:jeton');
define('JETONMEMBRE', ' WHERE id_membre=:id');
define('JETONDATE', ' SET date=:date');
define('JETONVALUES', ' (id_membre, jeton, ip_connexion, date) VALUES (:id, :jeton, :ip, :date)');
// les variables de recherche sur la table jeton d'activation par mail
define('JETONMAILVALUES', ' (id_membre, jeton) VALUES (:id, :jeton)');
define('JETONACTIVATION', ' WHERE jeton=:jeton');
// les variables de recherche sur la table message
define('IDEXP', ' WHERE id_expediteur=:id');
define('NBNEW', ' WHERE id_destinataire=:id AND lu!="1"');
define('MESSAGELISTE', ' WHERE id_destinataire=:id AND effacer="0" ORDER BY timestamp DESC');
define('MESSAGEINSERT', ' (id_expediteur, id_destinataire, titre, timestamp, message) VALUES (:id_exp, :id_dest, :titre, :date, :message)');
define('BIENVENUE', ' (id_expediteur, id_destinataire, titre, timestamp, message) VALUES (:id_exp, :id_dest, :titre, :date, :message)');
define('LU', ' SET lu="1"');
define('EFFACE', ' SET effacer="1"');
// les variables de recherche sur la table acces au information profil
define('MAJACCESPROFIL', '=:maj');
define('INSCRIPTION', '(id_membre) VALUES (:id)');
?>