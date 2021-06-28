<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_in_product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        $data = [
            'title'         => 'Stock In Product',
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('stock_in_products/index');
        $this->load->view('templates/footer');
    }

}