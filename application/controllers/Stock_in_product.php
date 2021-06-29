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
		$this->load->model('Supplier_model', 'supplier');
		$this->load->model('Product_model', 'product');
		$this->load->model('Stock_product_model', 'stock_product');
		$this->load->model('Stock_in_product_model', 'stock_in_product');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        $data = [
            'title'         => 'Stock In Product',
			'suppliers'		=> $this->supplier->get_suppliers()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('stock_in_products/index');
        $this->load->view('templates/footer');
    }

	public function stockInProcess()
    {
		$supplier_id = $this->input->post('supplier', TRUE);
		$product_id = $this->input->post('product', TRUE);
		$product_unit = $this->input->post('unit', TRUE);
		$product = $this->product->get_product_by_product_id($product_id);
		$raw_material_id = $product['raw_material_id'];

        $amount = $this->input->post('amount', TRUE);

        $amountFilter = $this->security->xss_clean($amount);

        $this->stock_product->input_stock_products($amountFilter, $raw_material_id, $product_id, $supplier_id);

        $data = [
            'no_transaction'    => $this->stock_in_product->get_stock_in_product_code(),
            'date'              => date('Y-m-d', strtotime($this->input->post('date', TRUE))),
            'supplier_id'       => $supplier_id,
            'raw_material_id'   => $raw_material_id,
            'product_id'      	=> $product_id,
            'product_unit'      => $product_unit,
            'amount'            => $amount,
            'price'             => $this->input->post('price', TRUE),
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $dataFilter = $this->security->xss_clean($data);

        $this->stock_in_product->stock_in_product($dataFilter);

        $this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Stock In Product has been updated!',showConfirmButton: false,timer: 1500})</script>");

        redirect('Stock_in_product');

    }

	public function getProduct($supplier_id)
	{
		$products = $this->stock_product->get_stock_products_by_supplier_id($supplier_id);

		echo "<option value='0' disabled selected>Select Product</option>";
		foreach ($products as $key => $product) {
			echo "<option value='". $product['product_id'] ."'>". ucwords($product['product_name']) . ' ' . $product['weight'] . ' ' . ucwords($product['product_unit']) ."</option>";
        }
	}

	public function getUnit($product_id)
    {
        $unit = $this->stock_product->get_stock_products_by_product_id($product_id);

        echo "<option value='". $unit['product_unit'] ."' readonly selected>". ucwords($unit['product_unit']) . "</option>";

    }

}