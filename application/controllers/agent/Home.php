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
			$form['id'] = $rid;
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
	public function dashboard($id=null)
	{
		$data['cars_list'] = $this->agent_model->get_rows(array('user_id'=> session_get('user')['id']), array('select'=>'cars.*, user.name as customer_name, user.email as customer_email', 'orderby'=>'cars.id'), false, array(array('table'=>'user', 'condition'=>'user.id=cars.rent_by', 'type'=>'LEFT')), 'cars');
		$this->load->view('layout/header');
		$this->load->view('agent/agent_dashboard', $data);
		$this->load->view('layout/footer');
	}
	public function add_car()
	{
		$form = $this->input->post();
		if(isset($form['id']) && !empty($form['id'])) {
			$rid = $this->agent_model->save($form, array('id'=>$form['id']), false, 'cars');
		} else {
			$form['user_id'] = session_get('user')['id'];
			$rid = $this->agent_model->save($form, NULL, true, 'cars');
		}
		if($rid) {
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully added.</div>');
			redirect('agent/dashboard');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('agent/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('agent/agent_dashboard');
		$this->load->view('layout/footer');
	}
	// public function update_car()
	// {		
	// 	$form = $this->input->post();
	// 	$rid = $this->agent_model->save($form, array('id'=>$form['id']), false, 'cars');
	// 	if($rid) {
	// 		$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully updated.</div>');
	// 		redirect('agent/dashboard');
	// 	} else {
	// 		$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
	// 		redirect('agent/dashboard');
	// 	}
	// 	$this->load->view('layout/header');
	// 	$this->load->view('agent/agent_dashboard');
	// 	$this->load->view('layout/footer');
	// }
}
