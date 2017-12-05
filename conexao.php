<?php

	// Conexão com o Banco de Dados
	$connect = mysql_connect("localhost", "root", "") or die (mysql_error ());

	// Seleciona o Banco de Dados
	$db = mysql_select_db("db_myworld") or die(mysql_error());

?>