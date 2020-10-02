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
			//select a database to work with
			// $selected = mysql_select_db($database,$dbhandle) or die("<div class='alert alert-danger'>Sorry, Database Not Found! Please contact Administrator.</div>");			
			return $dbhandle;
		}
	}
	
	$con = new connect_db;		
	$con_x_log = $con->connect_x_log();
	
	// $process_location = "../admin/upload_log_printing.php";
	
	$act = "load_log_printing";
	
	
	// $act = $_REQUEST["act"];
	// $type_id = $_REQUEST["type_id"];

	
	switch($act) {
		case "load_log_printing" : load_log_printing($con_x_log);  break;
	}

	function load_log_printing($con_x_log) {
			$path_folder = "//home//infx4544//public_html//dashboard//log//polis//new//";
// 			$path_folder = "C:\\xampp\\htdocs\\dashboard\\log\\polis\\new\\";
			if(is_dir($path_folder)) { 
				// $id_location_path_dnr = $rec_sel_dnr['id_location_path_dnr'];
				// $path_folder = $rec_sel_dnr['path_folder'];
				$folder_input = $path_folder;
				$folder_output = "//home//infx4544//public_html//dashboard//log//polis//done//";
				// 	$folder_output = "C:\\xampp\\htdocs\\dashboard\\log\\polis\\done\\";	
				if ($handle = opendir($folder_input)) {
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != ".." && $entry != "done") {
							if((strpos($entry,'PRINTING')) || (strpos($entry,'FINISHING')) || (strpos($entry,'RTP'))){
								load_log_file_status_policy ($con_x_log, $folder_input, $entry);
							}else{
								load_log_file_printing ($con_x_log, $folder_input, $entry);
							}
							
							move_log_file($folder_input, $folder_output, $entry);
						}
					}
					closedir($handle);
			   }
			}
		
	}
	

	function load_log_file_status_policy ($con_x_log, $folder, $file_name) {	
		echo "Load Log Printing ".$file_name;	
		$start_time = date("Y-m-d H:i:s");
		$file = $folder.$file_name;
		
		// $row_log_printing_summary_id = insert_log_printing_summary($con_x_log, $file_name);
		$row_update_log_status_detail = update_log_status_detail($con_x_log, $file, $file_name);
		// $row_log_printing_update_summary = update_log_printing_summary($con_x_log, $row_log_printing_summary_id, $row_log_printing_detail);
		
		$end_time = date("Y-m-d H:i:s");
		$duration = count_time($start_time, $end_time);
		
		echo " Finished in ".$duration."\n";

	}

    function load_log_file_printing ($con_x_log, $folder, $file_name) {	
		echo "Load Log Printing ".$file_name;	
		$start_time = date("Y-m-d H:i:s");
		$file = $folder.$file_name;
		
		// $row_log_printing_summary_id = insert_log_printing_summary($con_x_log, $file_name);
		$row_log_printing_detail = insert_log_printing_detail($con_x_log, $file, $file_name);
		// $row_log_printing_update_summary = update_log_printing_summary($con_x_log, $row_log_printing_summary_id, $row_log_printing_detail);
		
		$end_time = date("Y-m-d H:i:s");
		$duration = count_time($start_time, $end_time);
		
		echo " Finished in ".$duration."\n";

	}

	function update_log_status_detail($con_x_log, $file, $file_name)  {					

		$NoUrut = '';

		$qry_ins_log_daily_process = '';
		$sql_query = '';
		$date = ''; 
		$hold = '';
		$manifest = '';
		$remarks = '';
		$sql_ins_log_daily_process = '';
		$i = 1;		
		if ($fh = fopen($file, 'r')) {
		while(!feof($fh)){
			$row_txt = fgets($fh);
			//echo "Sukses";
			$x = 0;
			if(trim($row_txt)!="" && $i > 1){
				$row_txt = str_replace('"',"",$row_txt);
				$arr_row_txt = explode(",", $row_txt);
				$jml = 0;
				// $NoUrut = $arr_row_txt[0+$x];
				$customer = $arr_row_txt[0+$x];
                $project = $arr_row_txt[1+$x];
				$cycle = $arr_row_txt[2+$x];
				$NoPolis = $arr_row_txt[3+$x];
				$datetime = $arr_row_txt[4+$x];
				//$status = '';
                $remarks = $arr_row_txt[5+$x];
                // $cycle = $arr_row_txt[2+$x];
                if($cycle != ""){
                $dd = substr($cycle,6,2);
                $MM = substr($cycle,4,2);
                $YYYY = substr($cycle,0,4);
                
                $cycle = $YYYY."".$MM."".$dd;
				}
				if($datetime != ""){
					$dd = substr($datetime,6,2);
					$MM = substr($datetime,4,2);
					$YYYY = substr($datetime,0,4);
					
					$hh = substr($datetime,9,2);
					$mm = substr($datetime,11,2);
					$ss = substr($datetime,13,2);
					$datetime = $YYYY."-".$MM."-".$dd." ".$hh.":".$mm.":".$ss;
					$date = $dd."/".$MM."/".$YYYY;
				}




				if((strpos($file_name,'PRINTING'))){
				$sql_query = "UPDATE `xpr_product_routine` SET `printing_status` = 'done', `finish_printing` ='".$datetime."',  `status`= 3 WHERE `customer`='".$customer."' and project = '".$NoPolis."' and cycle = '".$cycle."'";
				$sql_ins_log_daily_process = "UPDATE `xpr_report_polis` SET `remarks` = '".$remarks."' ,`tgl_proses` = '".$datetime."' WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";
				}elseif ((strpos($file_name,'FINISHING'))){
				$sql_query = "UPDATE `xpr_product_routine` SET `balancing_status` = 'done', `finish_balancing` ='".$datetime."',  `status`= 5 WHERE `customer`='".$customer."' and project = '".$NoPolis."' and cycle = '".$cycle."'";
				$sql_ins_log_daily_process = "UPDATE `xpr_report_polis` SET `remarks` = '".$remarks."' ,`tgl_proses` = '".$datetime."' WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";
				}elseif ((strpos($file_name,'RTP'))){
				$hold = $arr_row_txt[6+$x];

				// var_dump($hold);
				// echo "".$hold;
				
				$hold = trim($hold);
				
				//PERUBAHAN STATUS UNTUK MANIFEST
				if (strcmp($hold,"HOLD DAILY")==0){
					$manifest = "H".$cycle;
				}elseif (strcmp($hold,"HOLD URGENT")==0){
					$manifest = "B".$cycle;
				}elseif (strcmp($hold,"HOLD QC")==0){
					$manifest = "C".$cycle;
				}else if (strcmp($hold,"REGULER")==0){
					$manifest = "R".$cycle;
				}else{
					$manifest = "NO MANIFEST";
				}				
				//PERUBAHAN STATUS UNTUK REMARKS HOLD
				if (strcmp($hold,"REGULER")==0){
					$hold = "DELIVERY";
				}elseif ((strcmp($hold,"HOLD DAILY")==0) || (strcmp($hold,"HOLD URGENT")==0) || (strcmp($hold,"HOLD QC")==0)){
					$hold = "DELIVERY PRU";
				}else{
					$hold = "NO DELIVERY";
				}
				
				$sql_query = "UPDATE `xpr_product_routine` SET `rtp_status` = 'done', `finish_rtp` ='".$datetime."',  `status`= 6 WHERE `customer`='".$customer."' and project = '".$NoPolis."' and cycle = '".$cycle."'";
				$sql_ins_log_daily_process = "UPDATE `xpr_report_polis` SET `remarks` = '".$hold."' ,`tgl_proses` = '".$datetime."', `manifest` = '".$manifest."' WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";	
				}

				//echo "PERCOBAAN : ".$file_name;
					// echo "".$file_name."\n";
					// echo "".$customer."\n";
					// echo "".$NoPolis."\n";
					// echo "".$cycle."\n";
					// echo "".$remarks."\n";
					// echo "\n";
				$result = mysqli_query($con_x_log, $sql_query);
				if ($result){
					$result2 = mysqli_query($con_x_log, $sql_ins_log_daily_process);
				}else{
					echo "Update Failed";
				}
				



				//and cycle = '".$cycle."' 
				// $sql_cek_summary_proccess = "SELECT * FROM xpr_product_routine WHERE customer = '".$customer."' and project = '".$NoPolis."' and cycle = '".$cycle."' LIMIT 1";
				// $result = mysqli_query($con_x_log, $sql_cek_summary_proccess);
				// echo "".$cycle;
				// if (mysqli_num_rows($result) > 0) {
				// 	echo "Select Record successfully</br>";
					
				// 	if (mysqli_query($con_x_log, $sql_query)) {
				// 		// if ($status = 'RTP'){
				// 		// 	$sql_ins_log_daily_process = "UPDATE `xpr_report_polis` SET `remarks` = '".$hold."' ,`tgl_proses` = '".$date."', `manifest` = '".$manifest."' WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";	
				// 		// }else{
				// 			$sql_ins_log_daily_process = "UPDATE `xpr_report_polis` SET `remarks` = '".$status."' ,`tgl_proses` = '".$date."' WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";	
				// 		// }
					  	
				// 		$qry_ins_log_daily_process = mysqli_query($con_x_log, $sql_ins_log_daily_process);
				// 		echo "Update Summary Proccess";
				// 	} else {
				// 	  echo "Error updating record: " . mysqli_error($con_x_log);
				// 	}
					
				// } else {
				// 	echo "Select Failed successfully";
				// }
                $jml++;		
			}
			$i++;
		}
	}

		return $qry_ins_log_daily_process;
		fclose($open_txt);
	}

	 function insert_log_printing_detail($con_x_log, $file, $file_name)  {					

		$NoUrut = '';
		$i = 1;		
		if ($fh = fopen($file, 'r')) {
		while(!feof($fh)){
			$row_txt = fgets($fh);
			echo "Sukses";
			$x = 0;
			if(trim($row_txt)!="" && $i > 1){
				$row_txt = str_replace('"',"",$row_txt);
				$arr_row_txt = explode(",", $row_txt);
				$jml = 0;
				$NoUrut = $arr_row_txt[0+$x];
				$customer = $arr_row_txt[1+$x];
                $NoPolis = $arr_row_txt[2+$x];
                $SPAJ = $arr_row_txt[3+$x];
                $produk = $arr_row_txt[4+$x];
                $issued = $arr_row_txt[5+$x];
                $cycle = $arr_row_txt[6+$x];
                if($cycle != ""){
                $dd = substr($cycle,0,2);
                $MM = substr($cycle,3,2);
                $YYYY = substr($cycle,6,4);
                
                $cycle = $YYYY."".$MM."".$dd;
                }
                $agency = $arr_row_txt[7+$x];
                $flagmedan = $arr_row_txt[8+$x];
                $remarks = 'PROCESS';
                $tgl_proses = $arr_row_txt[10+$x];
                $tat = $arr_row_txt[11+$x];
                $manifest = ''; 
                $status = $arr_row_txt[13+$x];
				$proses_date = $arr_row_txt[14+$x];
				
				if($proses_date != ""){
					$ddPoses_date = substr($proses_date,0,2);
					$MMPoses_date = substr($proses_date,3,2);
					$YYYYPoses_date = substr($proses_date,6,4);
					
					$hh = substr($proses_date,11,2);
					$mm = substr($proses_date,13,2);
					$ss = substr($proses_date,15,2);
					$proses_date = $ddPoses_date."/".$MMPoses_date."/".$YYYYPoses_date." ".$hh.":".$mm.":".$ss;
				}
				$epolicy = $arr_row_txt[15+$x];
				$delivery_option = $arr_row_txt[16+$x];
                $kartu_hs = $arr_row_txt[17+$x];
				$kartu_gah = $arr_row_txt[18+$x];
				if ($kartu_gah =='GAH'){
					$kartu_gah = 'Y';
				}else{
					$kartu_gah = 'N';
				}
                $vendor = $arr_row_txt[19+$x];
                $channel = $arr_row_txt[20+$x];
				$kode_agency = $arr_row_txt[21+$x];
				$tertanggung = $arr_row_txt[22+$x];
                echo "PERCOBAAN : ".$file_name; 
                $sql_cek_summary_proccess = "SELECT no_polis FROM xpr_report_polis WHERE customer = '".$customer."' and `no_polis`='".$NoPolis."' and cycle = '".$cycle."' LIMIT 1";
                $qry_cek_log_summary_proccess = mysqli_query($con_x_log, $sql_cek_summary_proccess) or die('ERROR cek sql_cek_summary_proccess: '.$sql_cek_summary_proccess);
                $count = mysqli_num_rows($qry_cek_log_summary_proccess);        
                if($count == 0) {               
                // $sql_ins_log_summary_proccess = "INSERT INTO `xpr_report_polis`(`no_urut`, `customer`,`no_polis`, `spaj`, `produk`, `issued`, `cycle`, `agency`, `flagmedan`, `remarks`, `tgl_proses`, `tat`, `manifest`, `status`, `proses_date`,`epolicy`,`delivery_option`) VALUES ('".$NoUrut."','".$customer."','".$NoPolis."','".$SPAJ."','".$produk."','".$issued."','".$cycle."','".$agency."','".$flagmedan."','".$remarks."','".$tgl_proses."','".$tat."','".$manifest."','".$status."','".$proses_date."','".$epolicy."','".$delivery_option."')";
                
                // $sql_ins_log_summary_proccess = "INSERT INTO `xpr_report_polis`(`no_urut`, `customer`, `no_polis`, `spaj`, `produk`, `issued`, `cycle`, `agency`, `flagmedan`, `remarks`, `tgl_proses`, `tat`, `manifest`, `status`, `proses_date`, `epolicy`, `delivery_option`, `kartu_hs`, `kartu_gah`, `vendor`) VALUES ('".$NoUrut."','".$customer."','".$NoPolis."','".$SPAJ."','".$produk."','".$issued."','".$cycle."','".$agency."','".$flagmedan."','".$remarks."','".$proses_date."','".$tat."','".$manifest."','".$status."','".$proses_date."','".$epolicy."','".$delivery_option."','".$kartu_hs."','".$kartu_gah."','".$vendor."')";
                $sql_ins_log_summary_proccess = "INSERT INTO `xpr_report_polis`(`no_urut`, `customer`, `no_polis`, `spaj`, `produk`, `issued`, `cycle`, `agency`, `flagmedan`, `remarks`, `tgl_proses`, `tat`, `manifest`, `status`, `proses_date`, `epolicy`, `delivery_option`, `kartu_hs`, `kartu_gah`, `vendor`, `channels`, `kode_agency`,`nama_tertanggung`) VALUES ('".$NoUrut."','".$customer."','".$NoPolis."','".$SPAJ."','".$produk."','".$issued."','".$cycle."','".$agency."','".$flagmedan."','".$remarks."','".$proses_date."','".$tat."','".$manifest."','".$status."','".$proses_date."','".$epolicy."','".$delivery_option."','".$kartu_hs."','".$kartu_gah."','".$vendor."', '".$channel."', '".$kode_agency."', '".$tertanggung."')";
                $qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
                echo "Return : '.$qry_ins_log_summary_proccess.'";
                }else{
                // $sql_ins_log_summary_proccess = "UPDATE `xpr_report_polis` SET `no_urut`='".$NoUrut."', `customer`='".$customer."', `no_polis`='".$NoPolis."', `spaj`='".$SPAJ."', `produk`='".$produk."' , `issued`='".$issued."' , `cycle`='".$cycle."' , `agency`='".$agency."' , `flagmedan`='".$flagmedan."' , `remarks`='".$remarks."' , `tgl_proses`='".$tgl_proses."', `tat`='".$tat."' , `manifest`='".$manifest."' , `status`='".$status."' , `proses_date`='".$proses_date."'  WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";
                $sql_ins_log_summary_proccess = "UPDATE `xpr_report_polis` SET `no_urut`='".$NoUrut."', `customer`='".$customer."', `no_polis`='".$NoPolis."', `spaj`='".$SPAJ."', `produk`='".$produk."' , `issued`='".$issued."' , `cycle`='".$cycle."' , `agency`='".$agency."' , `flagmedan`='".$flagmedan."' , `remarks`='".$remarks."' , `tgl_proses`='".$proses_date."', `tat`='".$tat."' , `manifest`='".$manifest."' , `status`='".$status."' , `proses_date`='".$proses_date."', `kartu_hs`='".$kartu_hs."' , `kartu_gah`='".$kartu_gah."' , `vendor`='".$vendor."', `channels`='".$channel."', `kode_agency`='".$kode_agency."', `nama_tertanggung`='".$tertanggung."'  WHERE `customer`='".$customer."' and no_polis = '".$NoPolis."' and cycle = '".$cycle."'";
                $qry_ins_log_summary_proccess = mysqli_query($con_x_log, $sql_ins_log_summary_proccess);
                echo "Update Summary Proccess";
                }
                $jml++;		
			}
			$i++;
		}
	}

		return $qry_ins_log_summary_proccess;
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
    
//     function get_client_ip() {
// 		$ipaddress = '';
// 		if (getenv('HTTP_CLIENT_IP'))
// 			$ipaddress = getenv('HTTP_CLIENT_IP');
// 		else if(getenv('HTTP_X_FORWARDED_FOR'))
// 			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
// 		else if(getenv('HTTP_X_FORWARDED'))
// 			$ipaddress = getenv('HTTP_X_FORWARDED');
// 		else if(getenv('HTTP_FORWARDED_FOR'))
// 			$ipaddress = getenv('HTTP_FORWARDED_FOR');
// 		else if(getenv('HTTP_FORWARDED'))
// 		   $ipaddress = getenv('HTTP_FORWARDED');
// 		else if(getenv('REMOTE_ADDR'))
// 			$ipaddress = getenv('REMOTE_ADDR');
// 		else
// 			$ipaddress = 'UNKNOWN';
// 		return $ipaddress;
// 	}
?>