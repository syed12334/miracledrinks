<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treatment extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/pthome
     *    - or -  
     *         http://example.com/index.php/blueadmin/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/pthome
     <method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
     
    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility_helper');
        $this->load->helper('cookie');
        no_cache();
        $this->load->model('home_db');
		$this->load->model('master_db');
		
	
        // $this->data['styleArrayunpaid']=array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFB8AA')));
    }
     public function listtreatment() {
    $id = $this->uri->segment(3);
    $this->data['data'] = $this->master_db->getRecords('treatment',['tid'=>$id,'status'=>0],'*');
    $this->load->view('treatment_list',$this->data);
   }
   public function profile() {
    $this->load->view('profile',$this->data);
   } 

}