<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Supplier_model', 'supplier');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'     => 'Supplier',
            'suppliers' => $this->supplier->get_suppliers()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('suppliers/index');
		$this->load->view('templates/footer');
    }
    
    public function addSupplier()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'address'       => $this->input->post('address', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->add_supplier($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Supplier has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');
    }

    public function editSupplier()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'address'       => $this->input->post('address', TRUE),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->edit_supplier($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Supplier has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');

    }

    public function deleteSupplier()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->supplier->delete_supplier($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Supplier has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('supplier');

    }
}
