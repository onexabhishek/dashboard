<?php
class Adp extends CI_Controller{
	public function plugins(){
		$this->load->model('adp_model');
		$data['title'] = 'Manage Plugins';
		$styles = $this->adp_model->load_plugin(['datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs','switchery'],'css');
		$meta['stylesheets'] = $styles;
		$this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		
		// $js = json_decode($this->adp_model->load_plugin('bootstrap'))->js;
		$this->load->view('admin/templates/header',$meta);
		$this->load->view('admin/manage_plugins',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
	public function get_plugins(){
	$file= './vendors';
		if(isset($_POST['folder'])){
			$file = $_POST['folder'];
		}
		$this->load->model("adp_model");
		echo $this->adp_model->getDatas($file,$_POST['action']);		
	}
	public function info_db(){
		$this->load->helper('file');
		$data['checked'] = $_POST['checked'];
		$data['ative_plugins'] = $_POST['ative_plugins'];
    if(!write_file('./db.json',json_encode($data))){
            echo 'Unable to write the file';
    	}else{
            echo 'File written!';
    	}
	}
	public function init_plugin($plugins = FALSE){
		$data = $this->load->model('adp_model');
		if($plugins){
			echo $this->adp_model->load_plugin($plugins);
		}else{
			echo $this->adp_model->load_plugin();
		}
		
	}
}