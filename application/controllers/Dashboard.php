<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
		date_default_timezone_set("Asia/Jakarta");
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
			'title' => 'Dashboard'
		];

		$this->load->view('templates/header', $data);
		$this->load->view('dashboards/index');
		$this->load->view('templates/footer');
	}
}
