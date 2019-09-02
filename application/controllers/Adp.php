<?php
class Adp extends CI_Controller{
	public function plugins(){
		$this->load->model('adp_model');
		$data['title'] = 'Manage Plugins';
		$meta['stylesheets'] = [
			'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
			'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
			'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
			'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
			'vendors/switchery/dist/switchery.min.css'
		];

		$script = $this->adp_model->load_plugin(['bootstrap','Flot','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
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