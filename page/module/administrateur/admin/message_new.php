<?php

session_start();

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
    if (file_exists("../../../../config/" . $page) && $page != 'index.php') {
        include "../../../../config/" . $page;
    } else {
        echo "Page inexistante !";
    }
}
echo '<div id="principal">
<div id="titre_principal">Nouveau Message</div>
<br />
<script language="javascript">
function smiley(texte){
document.formulaire.message.value+=" "+texte;
} 
</script>
<form method="post" action="" name="formulaire">
<table width="90%" align="center">';
if(!empty($_POST['envoie_message'])) {
	extract($_POST);
	echo '<tr><td colspan="2">';
	echo Message::messageEnvoi($_SESSION['id'], $destinataire, $titre, $message);
	echo '</tr></td>';
}
echo '<tr>
<td align="right" width="40%" class="titre_form">Selectionner Destinataire : </td>
<td>';
if(!empty($_GET['id'])) {
echo '<input type="hidden" value="'.$_GET['id'].'" name="destinataire" />
<input type="text" value="'.Membre::info($_GET['id'], 'pseudo').'" />';
}
else {
echo '<select name="destinataire">
<option>Choisir destinataire</option>
'.Message::choixDestinataire($_SESSION['id']).'
</select>';
} 
echo '</td>
</tr>
<tr>
<td align="right" class="titre_form">Titre du Message : </td>
<td><input type="text" name="titre" size="50" /></td>
</tr>
<tr>
<td align="right" class="titre_form" valign="top">Message : </td>
<td>
'.Smiley::liste().'
<br />
<textarea name="message" cols="60" rows="10"></textarea>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="envoie_message" value="Enoyer le Message" class="input" /></td>
</tr>
</table>
</form>
</div>';
?>