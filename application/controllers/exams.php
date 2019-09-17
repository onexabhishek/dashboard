<?php
class Exams extends CI_Controller{
	public function index(){
		$this->load->model('adp_model');
		$this->load->model('adp_crude');
		$styles = $this->adp_model->load_plugin(['datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs','switchery'],'css');
		$meta['stylesheets'] = $styles;
		// $this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		$data['title'] = 'Questions';
		$data['questions'] = $this->adp_crude->getRows('adp_questions');
		$this->load->view('admin/templates/header',$meta);
		$this->load->view('admin/questions',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
	public function add_question(){
		$this->load->model('adp_model');
		$this->load->model('adp_crude');
		$styles = $this->adp_model->load_plugin(['datatables.net-bs','datatables.net-buttons-bs','datatables.net-fixedheader-bs','datatables.net-responsive-bs','datatables.net-scroller-bs','switchery'],'css');
		$meta['stylesheets'] = $styles;
		// $this->output->cache(15);
		$script = $this->adp_model->load_plugin(['moment','bootstrap-daterangepicker','bootstrap-wysiwyg','jquery.hotkeys','google-code-prettify','jquery.tagsinput','switchery','select2','parsleyjs','devbridge-autocomplete','starrr'],'js');
		$script_data['scripts'] = $script;
		$data['title'] = 'Add Question';
		$data['categories'] = $this->adp_crude->getRows('adp_question_category',['where'=>['is_public'=>1]]);
		$this->load->view('admin/templates/header',$meta);
		$this->load->view('admin/add_question',$data);
		$this->load->view('admin/templates/footer',$script_data);
	}
	public function insert_question(){
		$this->load->model('adp_crude');
		$data = $this->adp_crude->insertRow($_REQUEST['table'],$_POST);
		echo !$data ? '0' : '1';
	}
}