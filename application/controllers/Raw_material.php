<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Raw_material extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Raw_material_model', 'raw_material');
        $this->load->model('Stock_raw_material_model', 'stock_raw_material');
        $this->load->model('Unit_model', 'unit');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data = [
            'title'         => 'Raw Material',
            'raw_materials' => $this->raw_material->get_raw_materials(),
            'units'         => $this->unit->get_units()
        ];

		$this->load->view('templates/header', $data);
		$this->load->view('raw_materials/index');
		$this->load->view('templates/footer');
    }
    
    public function addRawMaterial()
    {
        $data = [
            'code'          => $this->raw_material->get_raw_material_code(),
            'name'          => strtolower($this->input->post('name', TRUE)),
            'unit_id'       => $this->input->post('unit', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->add_raw_material($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'New Raw Material has been added!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');
    }

    public function editRawMaterial()
    {
        $data = [
            'name'          => strtolower($this->input->post('name', TRUE)),
            'unit_id'       => $this->input->post('unit', TRUE),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->edit_raw_material($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Raw Material has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');

    }

    public function deleteRawMaterial()
    {
        $data = [
            'is_deleted'        => '1',
            'remark_deleted'	=> strtolower($this->input->post('remark', TRUE)),
			'deleted_at'		=> date('Y-m-d H:i:s'),
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->raw_material->delete_raw_material($dataFilter, $this->input->post('id', TRUE));
        $this->stock_raw_material->delete_stock_raw_material_by_raw_material_id($dataFilter, $this->input->post('id', TRUE));

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Raw Material has been deleted!',showConfirmButton: false,timer: 1500})</script>");

        redirect('raw_material');

    }
}
