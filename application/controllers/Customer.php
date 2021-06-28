<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Customer_model', 'customer');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'     => 'Customer',
            'customers' => $this->customer->get_customers()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('customers/index');
		$this->load->view('templates/footer');
    }

    public function addCustomer()
    {
        $data = [
            'code'          => $this->customer->get_customer_code(),
            'name'          => strtolower($this->input->post('name', TRUE)),
            'pic'           => strtolower($this->input->post('pic', TRUE)),
            'phone'         => $this->input->post('phone', TRUE),
            'address'       => $this->input->post('address', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->customer->add_customer($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New customer has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('customer');
    }

    public function editCustomer()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'pic'           => strtolower($this->input->post('pic', TRUE)),
            'phone'         => $this->input->post('phone', TRUE),
            'address'       => $this->input->post('address', TRUE),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->customer->edit_customer($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Customer has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('customer');

    }

    public function deleteCustomer()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->customer->delete_customer($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Customer has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('customer');

    }
    
}