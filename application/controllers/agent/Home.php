<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
 	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('agent_model');
	}
	public function index()
	{
		$this->load->view('agent_login_index');
	}
	public function signup()
	{
		$this->load->view('agent_signup');
	}
	public function login()
	{
		$this->load->view('agent_login');
	}
	public function auth_signup()
	{
		$form = $this->input->post();		
		$form['is_customer'] = 0;
		$rid = $this->agent_model->save($form, NULL, true, 'user');
		if($rid) {
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('agent/dashboard');
		} else {
			$this->session->set_flashdata('','');
			redirect('agent/signup');
		}
		$this->load->view('agent_login');
	}
}
