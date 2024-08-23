<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
 	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('agent_model');
	}	

	public function index() {
		$data['cars_list'] = $this->agent_model->get_rows(array(), array('select'=>'*'), false, array(), 'cars');
		$this->load->view('layout/header');
		$this->load->view('customer/customer_dashboard', $data);
		$this->load->view('layout/footer');
	}
	
	public function auth_signup()
	{
		$form = $this->input->post();		
		$form['is_customer'] = 1;
		$rid = $this->agent_model->save($form, NULL, true, 'user');
		if($rid) {
			$form['id'] = $rid;
			$session_data = $form;
			$this->session->set_userdata('user', $session_data);
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('customer');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('customer');
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
			redirect('customer');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('customer');
		}
	}
	public function auth_signout()
	{
		$form = $this->input->post();
		$user_data = $this->agent_model->get_rows(array('email'=> $form['email'], 'password' => $form['password']), array('select'=>'*'), false, array(), 'user');
		if($user_data) {
			$session_data = $user_data[0];
			$this->session->set_userdata('user', $session_data);
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully logged In.</div>');
			redirect('customer');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('customer');
		}
	}
	public function rent_car()
	{
		$form = $this->input->post();
		$form['rent_by'] = session_get('user')['id'];
		$rid = $this->agent_model->save($form, array('id'=>$form['id']), false, 'cars');
		if($rid) {
			$this->session->set_flashdata('msg','<div class="alert alert-success">Successfully Booked.</div>');
			redirect('customer');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Please try again.</div>');
			redirect('customer');
		}
	}
}
