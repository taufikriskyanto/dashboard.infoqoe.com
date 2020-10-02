#!/usr/local/bin/php
<?php		

	class connect_db {
		protected $connect;

		function connect_x_log()  {
			$username = "infx4544_xpr_dashboard_log";
			$password = "4stragraphia!";
			$hostname = "localhost";  
			$database = "infx4544_xpr_dashboard_log";

// 			$username = "root";
// 			$password = "";
// 			$hostname = "localhost";  
// 			$database = "infx4544_xpr_dashboard_log";
		
			//connection to the database
			$dbhandle = mysqli_connect($hostname, $username, $password, $database) or die("<div class='alert alert-danger'>Sorry, Can't connect to database! Please contact Administrator.</div>");
			return $dbhandle;
		}
	}
	
	$con = new connect_db;		
	$con_x_log = $con->connect_x_log();
	
	$act = "load_log_printing";

	switch($act) {
		case "load_log_printing" : load_log_printing($con_x_log);  break;
	}

	function load_log_printing($con_x_log) {
			$path_folder ='//home//infx4544//public_html//dashboard//log//nonpolis//new//';
// 			$path_folder = "C:\\xampp\\htdocs\\dashboard\\log\\nonpolis\\new\\";
			//D:\Log dashboard\new
			if(is_dir($path_folder)) { 
				// $id_location_path_dnr = $rec_sel_dnr['id_location_path_dnr'];
				// $path_folder = $rec_sel_dnr['path_folder'];
				$folder_input ='//home//infx4544//public_html//dashboard//log//nonpolis//new//';
				$folder_output = '//home//infx4544//public_html//dashboard//log//nonpolis//done//';
				// $folder_input = "C:\\xampp\\htdocs\\dashboard\\log\\nonpolis\\new\\";
				// $folder_output = "C:\\xampp\\htdocs\\dashboard\\log\\nonpolis\\done\\";
				if ($handle = opendir($folder_input)) {
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != ".." && $entry != "done") {
							load_log_file_printing ($con_x_log, $folder_input, $entry);
							move_log_file($folder_input, $folder_output, $entry);
						}
					}
					closedir($handle);
			   }
			}

	}


	function load_log_file_printing ($con_x_log, $folder, $file_name) {	
		echo "Load Log Printing ".$file_name;	
		$start_time = date("Y-m-d H:i:s");
		$file = $folder.$file_name;
		
		$row_log_printing_summary_id = insert_log_printing_summary($con_x_log, $file_name);
		$row_log_printing_detail = insert_log_printing_detail($con_x_log, $file, $file_name, $row_log_printing_summary_id);
		// $row_log_printing_update_summary = update_log_printing_summary($con_x_log, $row_log_printing_summary_id, $row_log_printing_detail);
		
		$end_time = date("Y-m-d H:i:s");
		$duration = count_time($start_time, $end_time);
		
		echo " Finished in ".$duration."\n";

	}

	function insert_log_printing_summary($con_x_log, $file_name) {
		$ip =  get_client_ip();
		$log_printing_summary_id= '';
		$sql_cek_log_printing_summary = "SELECT file_name FROM xpr_product WHERE file_name = '".$file_name."' LIMIT 1";
		$qry_cek_log_printing_summary = mysqli_query($con_x_log, $sql_cek_log_printing_summary) or die('ERROR cek log_printing_summary: '.$sql_cek_log_printing_summary);
		$jml = mysqli_num_rows($qry_cek_log_printing_summary);		
		if($jml == 0) {
			$sql_insert_log_printing_summary="INSERT INTO  xpr_product (file_name, date_creation, ip_creation) VALUES ( '".$file_name."', now(), '".$ip."')";					
			$qry_insert_log_printing_summary = mysqli_query($con_x_log, $sql_insert_log_printing_summary) or die("<div class='alert failed'>Sorry, Can't insert log data! ".$sql_insert_log_printing_summary.mysqli_last_error()."</div>");
			if($qry_insert_log_printing_summary) {
				$sql = "SELECT MAX(`id_log_summary_dnr`) AS `id_log` FROM xpr_product WHERE `file_name`= '".$file_name."'";
				$qry_log_printing_summary_id = mysqli_query($con_x_log, $sql);
				while($row = mysqli_fetch_array($qry_log_printing_summary_id)){
					$log_printing_summary_id = $row['id_log'];
				}
							
			}
		}else{
			echo  'ERROR: file '.$file_name.' sudah pernah di-upload <br/>';
		}		
		echo "LOG PRINTING SUMMARY ID ".$log_printing_summary_id;
		return $log_printing_summary_id;
 	}

	 function insert_log_printing_detail($con_x_log, $file, $file_name, $row_log_printing_summary_id)  {					

		$row_log_printing_detail = '';
		$i = 1;		
		if ($fh = fopen($file, 'r')) {
		while(!feof($fh)){
			$row_txt = fgets($fh);
			echo "Sukses";
			$x = 0;
			if(trim($row_txt)!="" && $i > 1){
				$row_txt = str_replace("'","",$row_txt);
				$arr_row_txt = explode(";", $row_txt);
				$jml = 0;
				$customer = $arr_row_txt[0+$x];
				$produk = $arr_row_txt[1+$x];
				if($produk != ""){
				$produk_temp = explode("-",$produk);
				$project = $produk_temp[0];
				$produk = $produk_temp[1];
				// if(preg_match("/masak/i", $kalimat)) {
				// 		$status = 1;
				// 	}else{
				// 		$status = 2;
				//   }
				$posisi=strpos($project,"POLIS");
					if($posisi){
						$temp = $project;
						$project = $produk;
						$produk = $temp;
					}else{
						$status = 1;
					}
				}

				$cycle = $arr_row_txt[2+$x];
				
				$jumlah_kertas = $arr_row_txt[3+$x];
				$jumlah_amplop = $arr_row_txt[4+$x];
				$date_process  = $arr_row_txt[5+$x];
				if($date_process != "0" && $date_process != "") {
					$dd   = substr($date_process,6,2); 
					$MM   = substr($date_process,4,2);
					$YYYY = substr($date_process,0,4);
					$hour = substr($date_process,8,2);
					$minute = substr($date_process,10,2);
					$second = substr($date_process,12,2);
	
					$date_process = $YYYY."-".$MM."-".$dd." ".$hour.":".$minute.":".$second;
				}
				$sla = $arr_row_txt[6+$x];

				echo "PERCOBAAN : ".$row_log_printing_summary_id;
				if(strpos($produk,"POLIS")){
				$sql_cek_summary_proccess = "SELECT * FROM xpr_product_routine WHERE customer = '".$customer."' and project = '".$project."' and cycle = '".$cycle."' LIMIT 1";
				$qry_cek_log_summary_proccess = mysqli_query($con_x_log, $sql_cek_summary_proccess) or die('ERROR cek sql_cek_summary_proccess: '.$sql_cek_summary_proccess);
				$count = mysqli_num_rows($qry_cek_log_summary_proccess);
				if($count == 0) {				
					$sql_ins_log_summary_proccess = "INSERT INTO `xpr_product_routine`(`id_log_summary_dnr`, `customer`, `project` , `produk`, `cycle`, `total_pages`, `total_envelop`, `date_proccess`, `sla`,`status`) VALUES ('".$row_log_printing_summary_id."','".$customer."','".$project."','".$produk."','".$cycle."','".$jumlah_kertas."','".$jumlah_amplop."','".$date_process."','".$sla."',1)";
					$qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
					echo "Insert Summary Proccess polis";
					}else{
					$sql_ins_log_summary_proccess = "UPDATE `xpr_product_routine` SET `total_pages`='".$jumlah_kertas."', `total_envelop`='".$jumlah_amplop."', `date_proccess`='".$date_process."', `sla`='".$sla."'  WHERE customer = '".$customer."' and `project` = '".$project."' and `cycle` = '".$cycle."'";
					$qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
					echo "Update Summary Proccess polis";
					}		
				}else{
					$sql_cek_summary_proccess = "SELECT customer FROM xpr_product_routine WHERE customer = '".$customer."' and produk = '".$produk."' and cycle = '".$cycle."' LIMIT 1";
					$qry_cek_log_summary_proccess = mysqli_query($con_x_log, $sql_cek_summary_proccess) or die('ERROR cek sql_cek_summary_proccess: '.$sql_cek_summary_proccess);
					$count = mysqli_num_rows($qry_cek_log_summary_proccess);
					if($count == 0) {				
						$sql_ins_log_summary_proccess = "INSERT INTO `xpr_product_routine`(`id_log_summary_dnr`, `customer`, `project` , `produk`, `cycle`, `total_pages`, `total_envelop`, `date_proccess`, `sla`,`status`) VALUES ('".$row_log_printing_summary_id."','".$customer."','".$project."','".$produk."','".$cycle."','".$jumlah_kertas."','".$jumlah_amplop."','".$date_process."','".$sla."',1)";
						$qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
						echo "Insert Summary Proccess";
						}else{
						$sql_ins_log_summary_proccess = "UPDATE `xpr_product_routine` SET `total_pages`='".$jumlah_kertas."', `total_envelop`='".$jumlah_amplop."', `date_proccess`='".$date_process."', `sla`='".$sla."'  WHERE `customer` = '".$customer."' and `produk` = '".$produk."' and `cycle` = '".$cycle."'";
						$qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
						echo "Update Summary Proccess";
						}		
				}	


				$jml++;				
			}
			$i++;
		}
	}

		return $row_log_printing_detail;
		fclose($open_txt);
	}
	function count_time($start_time, $end_time) {
		$start_time = strtotime($start_time);
		if($end_time == "") {
			$end_time = date("Y-m-d H:i:s");
		}
		$end_time = strtotime($end_time);
		$time = $end_time-$start_time;	
		$minutes = (int)($time / 60);
		$seconds = (int)($time % 60);
		return str_pad($minutes, 2, "0", STR_PAD_LEFT)." : ".str_pad($seconds, 2, "0", STR_PAD_LEFT);
	}

	function move_log_file($folder_input, $folder_output, $file) {
		if($file != '') {	
			//echo "Move from ".$folder_input.$file." to ".$folder_output.$file;
			if (!rename($folder_input.$file, $folder_output.$file)) {				
				die("<div class='alert alert-danger'>Sorry, Failed moving file ".$file."! </div>");
			}
		} else  {				
			die("<div class='alert alert-danger'>Sorry, Failed upload file ".$file."! File Empty, Please choose another file! Or Check upload_max_filesize & post_max_size in PHP.ini</div>");
		}		
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
?>