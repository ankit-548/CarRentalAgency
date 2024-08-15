<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
 	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}
	public function agent_login()
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
}
