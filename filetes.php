<?php

	define('db_host','localhost');
	define('db_user','infx4544_xpr_dashboard_log');
	define('db_pass','4stragraphia!');
	define('db_name','infx4544_xpr_dashboard_log');
	
	mysql_connect(db_host,db_user,db_pass);
	mysql_select_db(db_name);
$sql="insert into xpr_product(id_log_summary_dnr,file_name,date_creation,ip_creation) values('','candra','3.00','TI')";
mysql_query($sql) or die(mysql_error());	

?>