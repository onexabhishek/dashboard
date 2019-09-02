<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function index()
	{
		$this->load->view('admin/templates/header');
		$this->load->view('pages');
		$this->load->view('admin/templates/footer');
	}
}
