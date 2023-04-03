	<!-- ENVOYER REQUETE POST AU CONTROLEUR (REQUETE INCONNUE QUI RENVOIE AU DEFAULT DU CONTROLEUR) -->
	<!-- <form method="POST" action="Controleur.php?action=controleur">
		<input type="hidden" name="redirection" value="true">
	</form> -->

	<!-- LANCER AUTOMATIQUEMENT LE SUBMIT DU FORM -->
	<!-- <script type="text/javascript">
		document.forms[0].submit();
	</script> -->

<?php
session_destroy();
header('Location: Login.php');
?>