<?php
class Services extends CI_Controller{
	public function index(){
		$this->load->helper('url');
		$data['title'] = 'Services';
		$meta['stylesheets'] = [
			'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
			'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
			'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
			'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'
		];
		$this->load->view('admin/templates/header',$meta);
		$this->load->view('admin/services',$data);
		$this->load->view('admin/templates/footer');
	}
	public function add(){
		$this->load->helper('url');
		$data['title'] = 'Services';
		$meta['stylesheets'] = [
			'vendors/google-code-prettify/bin/prettify.min.css',
			'vendors/select2/dist/css/select2.min.css',
			'vendors/switchery/dist/switchery.min.css',
			'vendors/starrr/dist/starrr.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css'
		];
		$script_data['scripts'] = [
			'vendors/google-code-prettify/bin/prettify.min.css',
			'vendors/select2/dist/css/select2.min.css',
			'vendors/switchery/dist/switchery.min.css',
			'vendors/starrr/dist/starrr.css',
			'vendors/bootstrap-daterangepicker/daterangepicker.css'
		];
		$this->load->view('admin/templates/header',$meta);
		$this->load->view('admin/add-service',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
}