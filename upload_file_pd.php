#!/usr/local/bin/php
<?php		

	class connect_db {
		protected $connect;

		function connect_x_log()  {
			$username = "infx4544_xpr_dashboard_log";
			$password = "4stragraphia!";
			$hostname = "localhost";  
			$database = "infx4544_xpr_dashboard_log";

			// $username = "root";
			// $password = "";
			// $hostname = "localhost";  
			// $database = "infx4544_xpr_dashboard_log";
		
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
			$path_folder ='//home//infx4544//public_html//dashboard//log//PD//new//';
			// $path_folder = "C:\\xampp\\htdocs\\dashboard\\log\\nonpolis\\new\\";
			//D:\Log dashboard\new
			if(is_dir($path_folder)) { 
				// $id_location_path_dnr = $rec_sel_dnr['id_location_path_dnr'];
				// $path_folder = $rec_sel_dnr['path_folder'];
				$folder_input ='//home//infx4544//public_html//dashboard//log//PD//new//';
				$folder_output = '//home//infx4544//public_html//dashboard//log//PD//done//';
				// $folder_input = "C:\\xampp\\htdocs\\dashboard\\uploads\\PD\\new\\";
				// $folder_output = "C:\\xampp\\htdocs\\dashboard\\uploads\\PD\\done\\";
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
		// $row_log_printing_update_summary = update_log_printing_summary($con_x_log, $row_log_printing_summary_id, $row_log_printing_detail);
		
		$end_time = date("Y-m-d H:i:s");
		$duration = count_time($start_time, $end_time);
		
		echo " Finished in ".$duration."\n";

	}

	function insert_log_printing_summary($con_x_log, $file_name) {
		$ip =  get_client_ip();
        $log_printing_summary_id= '';
        $path = 'log/PD/done/';
        $arr_row_txt = explode("_", $file_name);
        $cycle = $arr_row_txt[1];
        if($cycle != ""){
            $dd = substr($cycle,6,2);
            $MM = substr($cycle,4,2);
            $YYYY = substr($cycle,0,4);
            $cycle = $MM."/".$dd."/".$YYYY;
            
        }
        $dateproses =  $arr_row_txt[2];
        if($dateproses != ""){
            $dd = substr($dateproses,6,2);
            $MM = substr($dateproses,4,2);
            $YYYY = substr($dateproses,0,4);
            
            $hh = substr($dateproses,9,2);
            $mm = substr($dateproses,11,2);
            $ss = substr($dateproses,13,2);
            $dateproses = $YYYY."-".$MM."-".$dd." ".$hh.":".$mm.":".$ss;
            
        }
        $vendor = $arr_row_txt[3];
		$sql_cek_log_printing_summary = "SELECT nama_file FROM xpr_pru_file_pd WHERE cycle_file = '".$cycle."' and date_process ='".$dateproses."' and vendor ='".$vendor."' LIMIT 1";
		$qry_cek_log_printing_summary = mysqli_query($con_x_log, $sql_cek_log_printing_summary) or die('ERROR cek log_printing_summary: '.$sql_cek_log_printing_summary);
		$jml = mysqli_num_rows($qry_cek_log_printing_summary);		
		if($jml == 0) {
			$sql_insert_log_printing_summary=" INSERT INTO `xpr_pru_file_pd`(`id_file`, `nama_file`, `cycle_file`, `date_process`, `vendor`,`path`) VALUES ('','".$file_name."', '".$cycle."', '".$dateproses."', '".$vendor."', '".$path."')";
            if (mysqli_query($con_x_log, $sql_insert_log_printing_summary)){
                echo  $file_name.' berhasil ter-record <br/>';
            }else{
                echo  $file_name.' gagal ter-record <br/>';
            } 

		}else{
			echo  'ERROR: file '.$file_name.' sudah pernah di-upload <br/>';
		}		
		echo "LOG PRINTING SUMMARY ID ".$log_printing_summary_id;
		return $log_printing_summary_id;
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