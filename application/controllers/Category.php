<?php
class Category extends CI_Controller{
	public function index2(){
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->model('adp_model');
		$styles = $this->adp_model->load_plugin(['datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs','switchery'],'css');
		$meta['stylesheets'] = $styles;
		// $this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		$data['title'] = 'Category';
		
		$this->load->view('admin/templates/header',$meta);
		$this->parser->parse('admin/category',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
	public function index($name=FALSE){
		$this->load->model('adp_crude');
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->model('adp_model');

		$data['title'] = 'Add Category';
		$styles = $this->adp_model->load_plugin(['google-code-prettify','select2','switchery','starrr','bootstrap-daterangepicker','datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs'],'css');
		$meta['stylesheets'] = $styles;
		// $this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		// $data['alert'] = isset($_SESSION['alert']) ? $_SESSION['alert'] : '';
		$data['table_data']['result_rows'] = $this->adp_crude->getRows('adp_post_category',['select'=>['name,slug,parent_category']]);

		$this->load->view('admin/templates/header',$meta);
		if($name){
			$data['selected_data'] = $this->adp_crude->getRows('adp_post_category',['where'=>['slug'=>$name]]);
			$this->parser->parse('admin/view-category',$data);
		}else{
			$this->parser->parse('admin/add-category',$data);
		}
		$this->load->view('admin/templates/footer',$script_data);

	}
	public function add_category(){
		if(isset($_REQUEST['form_insert'])){
			$this->load->model('adp_crude');
			$res = $this->adp_crude->insertRows($_REQUEST['table'],$_POST);
			echo !$res ? '0' : '1';

			
		}
	}
	public function view($name){
		// if($name){
		// 	$data['data'] = '';
		// }
		$this->load->model('adp_crude');
		$data['selected_data'] = $this->adp_crude->getRows('adp_post_category',['where'=>['slug'=>$name]]);
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->model('adp_model');

		$data['title'] = 'View Category';
		$styles = $this->adp_model->load_plugin(['google-code-prettify','select2','switchery','starrr','bootstrap-daterangepicker','datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs'],'css');
		$meta['stylesheets'] = $styles;
		// $this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		// $data['alert'] = isset($_SESSION['alert']) ? $_SESSION['alert'] : '';
		$data['table_data']['result_rows'] = $this->adp_crude->getRows('adp_post_category',['select'=>['name,slug,parent_category']]);


		$this->load->view('admin/templates/header',$meta);
		$this->parser->parse('admin/add-category',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
}