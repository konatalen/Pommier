<?php
	function get_header($titre)
	{
		require '../view/header.php';
	}
	
	function get_footer()
	{
		require '../view/footer.php';
	}
		
	function handle_login_session()
	{
		session_start();
		if(isset($_GET['logout']))
		{
			unset($_SESSION);
			session_destroy();
			header ('Location: index.php');
			exit;
		}
	}
	
	function affiche_nav()
	{
		if(isset($_SESSION['isAdmin']))
		{
			if($_SESSION['isAdmin'])				
			{
				require '../view/nav_admin.php';
			}
			else
			{
				require '../view/nav_client.php';
			}
		}
		else
		{
			require '../view/unlogged_nav.php';
		}
	}
	
	function connexionBD()
	{
		// On se connecte à la BDD à l'adresse localhost avec le login profuser et le mdp profpass
		$link = mysql_connect("localhost", "profuser", "profpass")
			or die("Impossible de se connecter : " . mysql_error());
			
		//On choisit la BDD nommée site_vente
		mysql_select_db('site_vente',$link);
		
		// On retourne le lien de la connexion pour pouvoir la fermer ensuite
		return $link;
	}
	
	function checkIfAdmin()
	{
		if(!$_SESSION['isAdmin'])
		{		
			header('Location: forbidden.php');
			exit;
		}
	}
	
	function checkIfLoged()
	{
		if(!isset($_SESSION['login']))
		{
			header('Location: login.php');
			exit;
		}

	}
	
	function afficher_alertBox($alert)
	{
		if(!empty($alert))
			require "../view/alert.php";
	}	
?>