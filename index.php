<?php
	require_once('includes/config.php');
	require_once('Controllers/Cprincipal.php');
	$control=new Main();
	if (!isset($_REQUEST['p'])) {
		$control->index();
	}else{
		call_user_func(array($control,$_REQUEST['p']));
	}
?>