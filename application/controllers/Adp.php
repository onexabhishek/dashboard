<?php
class Adp extends CI_Controller{
	public function plugins(){

		$data['title'] = 'Manage Plugins';
		$meta['stylesheets'] = [
			'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
			'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
			'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
			'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
			'vendors/switchery/dist/switchery.min.css'
		];
		$script_data['scripts'] = [
			'vendors/moment/min/moment.min.js',
			'vendors/bootstrap-daterangepicker/daterangepicker.js',
			'vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
			'vendors/jquery.hotkeys/jquery.hotkeys.js',
			'vendors/google-code-prettify/src/prettify.js',
			'vendors/jquery.tagsinput/src/jquery.tagsinput.js',
			'vendors/switchery/dist/switchery.min.js',
			'vendors/select2/dist/js/select2.full.min.js',
			'vendors/parsleyjs/dist/parsley.min.js',
			'vendors/autosize/dist/autosize.min.js',
			'vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js',
			'vendors/starrr/dist/starrr.js'
		];
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
		$data = $_POST['data'];
    if(!write_file('./db.json', $data)){
            echo 'Unable to write the file';
    	}else{
            echo 'File written!';
    	}
	}
	public init_plugin(){
		$data = $this->load->model('load_plugin');
		echo $data;
	}
}