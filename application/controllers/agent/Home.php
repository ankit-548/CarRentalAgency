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
		$this->load->view('agent/agent_login_index');
	}
	public function signup()
	{
		$this->load->view('agent/agent_signup');
	}
	public function login()
	{
		$this->load->view('agent/agent_login');
	}
	public function auth_signup()
	{
		$form = $this->input->post();		
		$form['is_customer'] = 0;
		$rid = $this->agent_model->save($form, NULL, true, 'user');
		if($rid) {
			$session_data = $form;
			$this->session->set_userdata('user', $session_data);
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('agent/dashboard');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('agent/signup');
		}
	}
	public function auth_signin()
	{
		$form = $this->input->post();
		$user_data = $this->agent_model->get_rows(array('email'=> $form['email'], 'password' => $form['password']), array('select'=>'*'), false, array(), 'user');
		if($user_data) {
			$session_data = $user_data[0];
			$this->session->set_userdata('user', $session_data);
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('agent/dashboard');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('agent/sigin');
		}
		$this->load->view('agent/agent_login');
	}
	public function dashboard()
	{
		$this->load->view('layout/header');
		$this->load->view('agent/agent_dashboard');
		$this->load->view('layout/footer');
	}
	public function add_new_car()
	{
		$form = $this->input->post();
		$form['user_id'] = session_get('user')['id'];
		$rid = $this->agent_model->save($form, NULL, true, 'cars');
		if($rid) {
			$session_data = $form;
			$this->session->set_userdata('user', $session_data);
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('agent/dashboard');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('agent/signup');
		}
		$this->load->view('layout/header');
		$this->load->view('agent/agent_dashboard');
		$this->load->view('layout/footer');
	}
}
