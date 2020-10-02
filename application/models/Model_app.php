<?php

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function is_logged_in()
    {
        return $this->session->userdata('id_user');
    }
    //Punya AXI DASHBOARD MONITORING
    public function view_log_nuvera()
    {
    $query = $this->db->query('SELECT  * FROM xpr_log_printing_detail lpd  JOIN xpr_log_printing_summary lps 
    ON lpd.log_printing_summary_id = lps.log_printing_summary_id  JOIN xpr_m_machine ON xpr_m_machine.m_machine_id = lps.m_machine_id
    where disposition = "Print" AND (total_impressions_printed <> "0" OR total_impressions_printed = "Loaded" ) ORDER BY total_impressions_printed asc');
    return $query->result();
    }


    public function total_submitted()
	{
        $query = $this->db->query('SELECT  SUM(total_impressions_printed) FROM xpr_log_printing_detail');
        return $query->result();
    }

    public function get_list_machine()
	{
		$this->db->select('machine_name');
		$this->db->from('xpr_m_machine');
		$this->db->order_by('m_machine_id','asc');
		$query = $this->db->get();
		$result = $query->result();

		$machine= array();
		foreach ($result as $row) 
		{
			$machine[] = $row->machine_name;
		}
		return $machine;
    }
    

    public function get_customer()
    {

        $query = $this->db->query("SELECT * FROM xpr_customer_type A
                                   JOIN xpr_customer B ON B.customer_type_id = A.customer_type_id
                                   ORDER BY A.customer_type_id asc");
        return $query->result();

    }

    public function get_log_dnr()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where A.status = 1 ORDER BY A.date_approval_splod asc");
        return $query->result();

    }

    public function reupload_splod()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where A.status > 1 ORDER BY A.date_approval_splod desc");
        return $query->result();

    }

    public function report_customer(){
        $query = $this->db->query("SELECT C.customer_name, A.produk, A.splod, A.cycle, A.total_pages, A.total_envelop, A.project, A.date_proccess, A.date_approval_splod  
        FROM xpr_product_routine A
        JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
        JOIN xpr_customer C ON C.customer_code = A.customer
        where A.status = 6 ORDER BY A.id_log_summary_dnr asc");
        return $query->result();
    }
    
    public function pages_compelete($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  SUM(total_pages) AS tpc FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer");
        return $query->result();
    }
    
    public function envelops_compelete($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  SUM(total_envelop) AS tec FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer");
        return $query->result();
    }

    public function products_compelete($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  * FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and status = 6 and $qcustomer GROUP BY produk , cycle ")->num_rows();
        return $query->result();
    }
    
    public function total_pages($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  SUM(total_pages) AS tpc FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer");
        return $query->result();
    }
    
    public function total_envelops($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  SUM(total_envelop) AS tec FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer");
        return $query->result();
    }

    public function total_products($firstdate, $lastdate, $customer){
		if (empty($customer)){
			$qcustomer = "customer <> ''";
		}else{
			$qcustomer = "customer like '%$customer%'";
		}
        $query =  $this->db->query("SELECT  * FROM xpr_product_routine where date_proccess >= '$firstdate%'  and date_proccess <= '$lastdate%' and $qcustomer GROUP BY produk , cycle ")->num_rows();
        return $query->result();
    }
    
    public function report_customers_non($datefrom,$dateTo,$customer_code){
        $query = $this->db->query("SELECT C.customer_name, A.produk, A.splod, A.cycle, A.total_pages, A.total_envelop, A.project, A.date_proccess, A.date_approval_splod  
        FROM xpr_product_routine A
        JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
        JOIN xpr_customer C ON C.customer_code = A.customer
        where A.status = 6 AND A.cycle >= '$datefrom' AND A.cycle <= '$dateTo' AND customer = '$customer_code' ORDER BY A.id_log_summary_dnr asc");
        return $query->result();
    }

    public function report_customers_polis($datefrom,$dateTo,$customer_code){
        $query = $this->db->query("SELECT C.customer_name, A.produk, A.splod, A.cycle, A.total_pages, A.total_envelop, A.project, A.date_proccess, A.date_approval_splod  
        FROM xpr_product_routine A
        JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
        JOIN xpr_customer C ON C.customer_code = A.customer
        where A.status = 6 AND A.cycle >= '$datefrom' AND A.cycle <= '$dateTo' AND customer = '$customer_code' AND produk = 'BUKU POLIS' ORDER BY A.id_log_summary_dnr asc");
        return $query->result();
    }

    public function export($datefrom,$dateTo,$customer_code){
        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_customer B ON A.customer = B.customer_code 
                                   WHERE A.status = 6 AND A.cycle >= '$datefrom' AND A.cycle <= '$dateTo' AND customer = '$customer_code'");
        return $query->result();

    }

    public function change_status_polis($splod){
     $query = $this->db->query("SELECT * FROM xpr_product_routine B RIGHT JOIN xpr_report_polis A ON A.no_polis = B.project AND A.customer = B.customer AND A.cycle = B.cycle WHERE B.splod = '$splod' AND (B.status = 5 OR B.status = 6)");
     return $query->result();
   
    }
    public function export_polis($datefrom,$dateTo,$customer_code){
        $query = $this->db->query("SELECT * FROM xpr_report_polis 
                                   WHERE cycle >= '$datefrom' AND cycle <= '$dateTo' AND customer = '$customer_code'");
        return $query->result();

    }

    public function insert_report_polis($datefrom,$customer_code){
        $query = $this->db->query("SELECT * FROM xpr_product_routine 
                                   WHERE cycle = '$datefrom' AND customer = '$customer_code'");
        return $query->result();
    }

    public function check_login_session($dataSession){
        //CHECKING USER DENGAN EXPIRED LOGIN ABIS ITU BARU INSERT DAN LOGIN KE HOME
        $username =  $dataSession['username'];
        $dateCheckIn =  $dataSession['dateCheckIn'];
        // $this->lastlogin =  $data['lastlogin'];
        // $this->expiredlogin =  $data['expiredlogin'];
        $this->db->select('*');
        $this->db->from('xpr_log_login');
        $this->db->where('expiredlogin <',$dateCheckIn);
        $this->db->where('username',$username);
        $query = $this->db->get();
        $value = false;
        if ( $query->num_rows() > 0 )
        {
            $value = true;
        }
        return $value;
    }

    public function insert_datalog($data){
        //CHECKING USER DENGAN EXPIRED LOGIN ABIS ITU BARU INSERT DAN LOGIN KE HOME
        $this->username =  $data['username'];
        $this->user_group =  $data['user_group'];
        $this->lastlogin =  $data['lastlogin'];
        $this->expiredlogin =  $data['expiredlogin'];

        if($this->db->insert('xpr_log_login',$this))
        {    
            return 'Data is inserted successfully';
        }
          else
        {
            return "Error has occured";
        }

    }
    

    public function get_printing()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where A.status = 2   ORDER BY A.id_log_summary_dnr asc");
        return $query->result();

    }

    public function reporting_polis()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine");
        return $query->result();

    }

    public function get_inserting()
    {
        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where A.status = 3  ORDER BY A.id_log_summary_dnr asc");
        return $query->result();
    }


    public function get_file($customer_code)
    {
        $query = $this->db->query("SELECT * FROM xpr_customer_file A where A.customer = '$customer_code'  ORDER BY A.createdby asc");
        return $query->result();
    }

    public function search_data_hold($params){

        $qcustomer_code = '';
        $qcycle_file = '';
        $customer_code = $params['customer_id'];
    
        if (trim($customer_code)=="customer"){
                $qcustomer_code = "customer <> ''";
        }else{
                $qcustomer_code = "customer like '%$customer_code%'";
        }
       
        $cycle = $params['cycle'];
        if (empty($cycle)){
			$qcycle_file = "cycle_file <> ''";
		}else{
			$qcycle_file = "cycle_file like '%$cycle%'";
		}

        $query = $this->db->query("SELECT * FROM xpr_customer_file where  ($qcycle_file) and (customer = '$customer_code')");
        return $query->result();
    }
    
        public function search_file_pd($params){

        $qcycle = '';
        $qvendor = '';
        $cycle = $params['cycle'];
        $vendor = $params['vendor'];
        if (trim($vendor)=="customer"){
                $qvendor = "vendor <> ''";
        }else{
                $qvendor = "vendor like '%$vendor%'";
        }
       
      
        if (empty($cycle)){
			$qcycle_file = "cycle_file <> ''";
		}else{
			$qcycle_file = "cycle_file like '%$cycle%'";
		}

        $query = $this->db->query("SELECT * FROM xpr_pru_file_pd where  ($qcycle_file) and ($qvendor)");
        return $query->result();
    }

    public function download_pd ($id_file){
        $query = $this->db->query("SELECT nama_file, path FROM xpr_pru_file_pd where id_file = '$id'");
        return $query->result();
    }
    public function view_non_polis($customer_code, $product, $Cyclefrom, $Cycleto){
        if (empty($Cyclefrom) or empty($Cycleto)){
			$qCycle = "cycle <> ''";
		}else{
			//MM/DD/YYYY
			$qCycle = "cycle BETWEEN '$Cyclefrom' and '$Cycleto'";
        }
        if (empty($product)){
			$qProduk = "produk <> ''";
		}else{
			$qProduk = "produk like '%$product%'";
		}
        $query = $this->db->query("SELECT * FROM xpr_product_routine  where status > 1 and produk <> 'BUKU POLIS' and customer = '$customer_code' and $qCycle and $qProduk ORDER BY id_log_summary_dnr_detail asc");
        return $query->result();
    }
    
    public function view_polis($data)
    {

        $customer_code = $data['customer_code'];
        $datefrom = $data['cycle_from'];
        $dateTo =  $data['cycle_end'];
        $product = $data['product'];
        $agency_code = $data['agency_code']; 
        $delivery = $data['delivery_option']; 
        $epolicy =  $data['policy'] ;
        $manifest = $data['manifes'] ;
        $kartu_hs = $data['kartu_hs'] ;
        $kartu_gah =  $data['kartu_gah'];
        $vendor = $data['vendor'];
        $channels = $data['channels'];
		if (empty($datefrom) or empty($dateTo)){
			$qCycle = "cycle <> ''";
		}else{
			//MM/DD/YYYY
			// $datefrom = substr($datefrom,7,4).substr($datefrom,1,2).substr($datefrom,4,2);
			// $dateTo = substr($dateTo,7,4).substr($dateTo,1,2).substr($dateTo,4,2);
			$qCycle = "cycle BETWEEN '$datefrom' and '$dateTo'";
		}
		
// 		if (empty($issued_datefrom) or empty($issued_dateend)){
// 			$qIssued = "issued <> ''";
// 		}else{
// 			// $issued_datefrom = substr($issued_datefrom,7,4).substr($issued_datefrom,1,2).substr($issued_datefrom,4,2);
// 			// $issued_dateend = substr($issued_dateend,7,4).substr($issued_dateend,1,2).substr($issued_dateend,4,2);
// 			$qIssued = "issued BETWEEN '$issued_datefrom' and '$issued_dateend'";
// 		}
		
		if (empty($product)){
			$qProduk = "produk <> ''";
		}else{
			$qProduk = "produk like '%$product%'";
		}
		if (empty($agency_code)){
			$qAgency = "agency <> ''";
		}else{
			$qAgency = "agency like '%$agency_code%'";
		}
		if (trim($delivery)=="ALL"){
			$qDelivery = "delivery_option <> ''";
		}else{
			$qDelivery = "delivery_option  like '%$delivery%'";
		}
		if (trim($epolicy)=="ALL"){
			$qEpolicy = "epolicy <> ''";
		}else{
			$qEpolicy = "epolicy like '%$epolicy%'";
		}
		if (trim($manifest)=="ALL"){
			$qManifest= "manifest <> ''";
		}else{
			$qManifest= "manifest like '%$manifest%'";
		}
		
		if (trim($channels)=="ALL"){
			$qchannels= "channels <> ''";
		}else{
			$qchannels= "channels like '%$channels%'";
		}
		
		if (trim($kartu_hs)=="ALL"){
			$qkartu_hs = "kartu_hs <> ''";
		}else{
			$qkartu_hs = "kartu_hs  like '%$kartu_hs%'";
		}
		if (trim($kartu_gah)=="ALL"){
			$qkartu_gah = "kartu_gah <> ''";
		}else{
			$qkartu_gah = "kartu_gah  like '%$kartu_gah%'";
		}
		if (trim($vendor)=="ALL"){
			$qvendor = "vendor <> ''";
		}else{
			$qvendor = "vendor  like '%$vendor%'";
		}
		//$query = $this->db->query("SELECT * FROM xpr_report_polis where ($qCycle) AND ($qIssued) AND ($qProduk) AND ($qAgency) AND ($qDelivery) AND ($qEpolicy) AND ($qManifest) and ($qkartu_hs) and ($qkartu_gah) and ($qvendor) and (customer = '$customer_code')");		
		$query = $this->db->query("SELECT * FROM xpr_report_polis where ($qCycle) AND ($qProduk) AND ($qAgency) AND ($qDelivery) AND ($qEpolicy) AND ($qManifest) and ($qkartu_hs) and ($qkartu_gah) and ($qvendor)  and ($qchannels) and (customer = '$customer_code')");
		//$query = $this->db->query("SELECT * FROM xpr_report_polis where (cycle like '%$datefrom%' and '%$dateTo%') OR (issued like '%$issued_datefrom%' and '%$issued_dateend%') OR produk like '%$product%' OR agency like '%$agency_code%' 
        //                            OR delivery_option  like '%$delivery%' OR epolicy like '%$epolicy%' OR manifest like '%$manifest%' and customer = '$customer_code'");
        // var_dump($query);
        // die;
        return $query->result();
    }
	public function view_policy_summary($data)
    {

        $customer_code = $data['customer_code'];
        $datefrom = $data['cycle_from'];
        $dateTo =  $data['cycle_end'];
        $delivery = $data['delivery_option']; 
        $epolicy =  $data['policy'] ;
        $manifest = $data['manifes'] ;
        $vendor = $data['vendor'];
		if (empty($datefrom) or empty($dateTo)){
			$qCycle = "xpr_report_polis.cycle <> ''";
		}else{
			$qCycle = "xpr_report_polis.cycle BETWEEN '$datefrom' and '$dateTo'";
		}
		
		


		if (trim($delivery)=="ALL"){
			$qDelivery = "delivery_option <> ''";
		}else{
			$qDelivery = "delivery_option  like '%$delivery%'";
		}
		if (trim($epolicy)=="ALL"){
			$qEpolicy = "epolicy <> ''";
		}else{
			$qEpolicy = "epolicy like '%$epolicy%'";
		}
		if (trim($manifest)=="ALL"){
			$qManifest= "manifest <> ''";
		}else{
			$qManifest= "manifest like '%$manifest%'";
		}
		
		// if (trim($kartu_hs)=="ALL"){
		// 	$qkartu_hs = "kartu_hs <> ''";
		// }else{
		// 	$qkartu_hs = "kartu_hs  like '%$kartu_hs%'";
		// }
		// if (trim($kartu_gah)=="ALL"){
		// 	$qkartu_gah = "kartu_gah <> ''";
		// }else{
		// 	$qkartu_gah = "kartu_gah  like '%$kartu_gah%'";
		// }
		if (trim($vendor)=="ALL"){
			$qvendor = "vendor <> ''";
		}else{
			$qvendor = "vendor  like '%$vendor%'";
		}
		//$query = $this->db->query("SELECT * FROM xpr_report_polis where ($qCycle) AND ($qIssued) AND ($qProduk) AND ($qAgency) AND ($qDelivery) AND ($qEpolicy) AND ($qManifest) and ($qkartu_hs) and ($qkartu_gah) and ($qvendor) and (customer = '$customer_code')");		
		//$query = $this->db->query("SELECT * FROM xpr_report_polis where ($qCycle) AND  ($qDelivery) AND ($qEpolicy) AND ($qManifest)  and ($qvendor)   and (customer = '$customer_code')");
        $query =  $this->db->query("SELECT xpr_report_polis.cycle, xpr_report_polis.vendor, xpr_report_polis.epolicy, xpr_report_polis.manifest, xpr_report_polis.delivery_option, COUNT(xpr_product_routine.total_pages) as total_pages FROM `xpr_report_polis`  LEFT JOIN `xpr_product_routine`  ON xpr_report_polis.no_polis = xpr_product_routine.project LEFT JOIN xpr_product_routine pr ON xpr_report_polis.cycle = xpr_product_routine.project where ($qCycle) AND  ($qDelivery) AND ($qEpolicy) AND ($qManifest)  and ($qvendor)  GROUP BY vendor , epolicy, delivery_option ");
        return $query->result();
    }
	//edited by m3
	/* public function view_polis($customer_code,$datefrom,$dateTo,$issued_datefrom,$issued_dateend,$product,$agency_code,$delivery,$epolicy,$manifest)
    {
		if (empty($datefrom) or empty($datefrom)){
			$qCycle = "cycle "
		}
        $query = $this->db->query("SELECT * FROM xpr_report_polis where (cycle like '%$datefrom%' and '%$dateTo%') OR (issued like '%$issued_datefrom%' and '%$issued_dateend%') OR produk like '%$product%' OR agency like '%$agency_code%' 
                                    OR delivery_option  like '%$delivery%' OR epolicy like '%$epolicy%' OR manifest like '%$manifest%' and customer = '$customer_code'");
        return $query->result();
    } */

    public function get_balancing()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where A.status = 4  ORDER BY A.id_log_summary_dnr asc");
        return $query->result();

    }

    public function get_sales_order_demo(){
        
        $query = $this->db->query("SELECT * FROM xpr_surat_order so JOIN xpr_user us ON so.pic_order = us.user_id where status <> 10
        ORDER BY incoming_date asc");
        
        return $query->result();
    }

    public function get_failed_printing_facillity(){
        
        $query = $this->db->query("SELECT * FROM xpr_surat_order so JOIN xpr_user us ON so.pic_order = us.user_id where status = 10
        ORDER BY incoming_date asc");
        
        return $query->result();
    }

    public function save_files($data){
        $info_file = $data['info_file'];
		$cycle_file = $data['cycle_file'];
        $myfile = $data['myfile'];
        $path_file = $data['path_file'];
        $customer_code = $data['customer_code'];
        $type_data = $data['type_data'];
        
        $data = array(
            'customer' => $customer_code,
            'info_files'=>$info_file,
            'cycle_file'=>$cycle_file,
            'name_file' => $myfile,
            'path_file' => $path_file,
            'type_data' => $type_data
        );
    
        $this->db->insert('xpr_customer_file',$data);
    }

    public function get_rtp()
    {

        $query = $this->db->query("SELECT * FROM xpr_product_routine A
                                   JOIN xpr_product B ON B.id_log_summary_dnr = A.id_log_summary_dnr
                                   where  A.status = 5 ORDER BY A.id_log_summary_dnr asc");
        return $query->result();

    }



    public function get_printing_facillity()
    {

        $query = $this->db->query("SELECT * FROM xpr_surat_order so JOIN xpr_user us ON us.user_id = so.pic_order
                                   where status = 1 order by incoming_date asc");
        return $query->result();

    }

    public function get_finishing_facillity()
    {

        $query = $this->db->query("SELECT * FROM xpr_surat_order so JOIN xpr_user us ON us.user_id = so.pic_order
                                    where status = 2 order by incoming_date asc");
        return $query->result();

    }

    public function get_type_customer()
    {

        $query = $this->db->query("SELECT * FROM xpr_customer_type GROUP BY customer_type_name");
        return $query->result();

    }

    public function check_account($username,$password){
        $query = $this->db->query("SELECT * FROM xpr_user WHERE user_name = '$username' and password = '$password'");
        return $query->result_array();
    }

    public function dropdown_customer_type()
    {
        $query = $this->db->query('SELECT * FROM xpr_customer_type ORDER BY customer_type_name');
        return $query->result();
    }
    
    public function dropdown_mesin()
    {
        $query = $this->db->query('SELECT * FROM xpr_mesin_materai ORDER BY id_mesin');
        return $query->result();
    }

    public function dropdown_product($customer_code){
        $query = $this->db->query("SELECT  DISTINCT(produk)  FROM xpr_product_routine WHERE produk <> 'BUKU POLIS' and customer = '$customer_code'");
        return $query->result(); 
    }
    
    public function data_materai($params)
    {
        $qvendor= '';
        $qcycle = '';
        $vendor = $params['vendor'];
        $cycle = $params['cycle'];
    
		if (trim($vendor)=="ALL"){
			$qvendor = "xpr_mesin_materai.vendor <> ''";
		}else{
			$qvendor = "xpr_mesin_materai.vendor  like '%$vendor%'";
		}
       
       
        if (empty($cycle)){
			$qcycle = "xpr_materai.cycle <> ''";
		}else{
			$qcycle = "xpr_materai.cycle like '%$cycle%'";
		}
		
        // $query = $this->db->query(' where  ($qvendor) and ($qcycle) ');
         $query =  $this->db->query("SELECT * FROM xpr_materai LEFT JOIN xpr_mesin_materai ON xpr_materai.id_mesin_materai =  xpr_mesin_materai.id_mesin  where ($qcycle)  and ($qvendor) ORDER BY xpr_materai.id_materai asc");
        return $query->result();
    }
    

    


    
    public function dropdown_customer()
    {
        $query = $this->db->query('SELECT * FROM xpr_customer ORDER BY customer_name ASC');
        return $query->result();
    }


    public function customer_type($id)
    {

        $query = $this->db->query("SELECT customer_type_name, stats FROM xpr_customer_type 
                                   WHERE customer_type_id ='$id'");
        return $query->result();

    }

    // public function dropdown_customer($customer_type_id)
    // {
    //     $sql = "SELECT * FROM xpr_customer_type where customer_type_id ='$customer_type_id'";
    //     $query = $this->db->query($sql);
    //     return $query;
    // }

    public function getCustomerType($customer_type_id){
        $query = $this->db->query("SELECT customer_type_id FROM xpr_customer_type 
        WHERE customer_type_id ='$customer_type_id'");
        return $query->result();
    }

    public function check_customer($id)
    {

        $query = $this->db->query("SELECT * FROM xpr_customer_type 
                                   WHERE customer_type_id ='$id'");
        return $query->result();

    }

    public function view_monitoring(){
        $query = $this->db->query("SELECT * FROM xpr_product_routine ldd JOIN xpr_product lsd ON lsd.id_log_summary_dnr = ldd.id_log_summary_dnr  ORDER BY id_log_summary_dnr_detail asc");
        return $query->result();
    }
    public function view_monitoring_nonpolis($customer_code){
        $query = $this->db->query("SELECT * FROM xpr_product_routine  where status > 1 and produk <> 'BUKU POLIS' and customer = '$customer_code' ORDER BY id_log_summary_dnr_detail asc");
        return $query->result();
    }

    public function view_monitoring_customer($customer_code){
        $query = $this->db->query("SELECT * FROM xpr_report_polis where customer ='$customer_code' ORDER BY cycle desc");
        return $query->result();
    }

    public function approval_jobs_many(){
        $query = $this->db->query('SELECT * FROM xpr_product_routine where status =  1 
        GROUP BY customer, cycle, produk ORDER BY id_log_summary_dnr_detail');
        return $query->result();
    }

    public function view_monitoring_facillity(){
        $query = $this->db->query("SELECT * FROM xpr_surat_order so JOIN xpr_user us ON so.pic_order = us.user_id Order By Incoming_date asc");
        return $query->result();
    }

    public function get_list_printing()
	{
        $query = $this->db->query("SELECT SUM(total_pages) as total_pages, finish_printing as start_date, finish_printing as end_date
        from xpr_product_routine WHERE printing_status ='done' 
        GROUP BY YEAR(finish_printing), MONTH(finish_printing), DAY(finish_printing)");
        return $query->result();
    }
    
    public function menus() {
        $this->db->select("*");
        $this->db->from("xpr_menu");
        $q = $this->db->get();
    
        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
    
                $this->db->select("*");
                $this->db->from("xpr_sub_menu");
                $this->db->where("menu_id", $row->menu_id);
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $row->children = $q->result();
                }
                array_push($final, $row);
            }
        }
        return $final;
    }

    public function data_dnrdetail($id){
        $query = $this->db->query("SELECT * FROM xpr_product_routine 
                                    WHERE id_log_summary_dnr_detail ='$id' 
                                    ORDER BY id_log_summary_dnr_detail asc");
        return $query->result();
    }

	public function simpan_upload($judul,$path,$files){
		$data = array(
                'judul' => $judul,
                'path' => $path,
	        	'file' => $files
	       	);  
	    $result= $this->db->insert('xpr_data_customers',$data);
	    return $result;
	}

    // public function data_profile($id){
    //     $query = $this->db->query("SELECT * FROM xpr_product_routine 
    //                                 WHERE id_log_summary_dnr_detail ='$id' 
    //                                 ORDER BY id_log_summary_dnr_detail asc");
    //     return $query->result();
    // }
    //SAMPAI DIATAS INI

    public function datalist_ticket()
    {

        $query = $this->db->query("SELECT * FROM xpr_customer_type A
        JOIN xpr_customer B ON A.customer_type_id = B.customer_type_id
        ORDER BY A.customer_type_id asc");
        return $query->result();

    }

    public function data_trackingticket($id)
    {

        $query = $this->db->query("SELECT A.tanggal, A.status, A.deskripsi, B.nama
                                   FROM tracking A 
                                   LEFT JOIN karyawan B ON B.nik = A.id_user
                                   WHERE A.id_ticket ='$id'");
        return $query->result();

    }


    public function datainformasi()
    {

        $query = $this->db->query("SELECT A.tanggal, A.subject, A.pesan, C.nama, A.id_informasi
                                   FROM informasi A 
                                   LEFT JOIN karyawan C ON C.nik =  A.id_user
                                   WHERE A.status = 1");
        return $query->result();

    }

    public function datamyticket($id)
    {
        $query = $this->db->query("SELECT A.progress, A.tanggal_proses, A.tanggal_solved, A.id_teknisi, D.feedback, A.status, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                                   LEFT JOIN history_feedback D ON D.id_ticket = A.id_ticket
                                   WHERE A.reported = '$id' ");
    return $query->result();
    }


    
    public function last_index_mesin(){
        
    $query = $this->db->query("SELECT MAX(`id_mesin`) as id_mesin FROM `xpr_mesin_materai` ");
    
    return $query->result();
    
    }

    public function save_first_record_mesin($data){
        $id_mesin = $data['id_mesin'];
        $cycle_materai = $data['cycle_materai'];
		$cycle = $data['cycle'];
        $jumlah_terpakai = $data['jumlah_terpakai'];
        $no_akhir = $data['no_akhir'];
        $no_awal = $data['no_awal'];
        $saldo = $data['saldo'];
        $top_up = $data['top_up'];
        $saldo_top_up = $data['saldo_top_up'];
        
        $data = array(
            'id_mesin_materai' => $id_mesin,
            'tanggal_materai' => $cycle_materai,
            'cycle'=>$cycle,
            'jumlah_terpakai'=>$jumlah_terpakai,
            'no_akhir' => $no_akhir,
            'no_awal' => $no_awal,
            'saldo' => $saldo,
            'top_up' => $top_up,
            'saldo_top_up' => $saldo_top_up,
        );
    
        $this->db->insert('xpr_materai',$data);
    }


   

   

}