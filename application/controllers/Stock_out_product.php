<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_out_product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
            redirect('auth');
		}
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Product_model', 'product');
		$this->load->model('Supplier_model', 'supplier');
		$this->load->model('Stock_product_model', 'stock_product');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        $data = [
            'title'         => 'Stock Out Product',
			'suppliers'		=> $this->supplier->get_suppliers()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('stock_out_products/index');
        $this->load->view('templates/footer');
    }

	public function add_to_cart()
	{
		$product_id = $this->input->post('product');
		$supplier_id = $this->input->post('supplier');
		$products = $this->product->get_product_by_product_id($product_id);
		$stock_products = $this->stock_product->get_stock_product_by_product_supplier_id( $product_id, $supplier_id);

		$data = [
			'id'						=> $stock_products['id'],
			'name'						=> $products['product_name'],
			'supplier_id'				=> $supplier_id,
			'product_id'				=> $product_id,
			'product_unit'				=> $products['product_unit'],
			'weight'					=> $products['weight'],
			'selling_price_of_goods'	=> $products['selling_price_of_goods'],
			'qty'						=> $this->input->post('amount'),
			'price'						=> $products['selling_price_of_goods']
		];

		$this->cart->insert($data);

		redirect('stock_out_product');
	}

	public function remove()
	{
		$row_id = $this->uri->segment(3);

		$this->cart->update([
			'rowid' => $row_id,
			'qty'   => 0
		]);

		redirect('stock_out_product');
	}

	public function getProduct($supplier_id)
	{
		$products = $this->stock_product->get_stock_products_by_supplier_id($supplier_id);

		echo "<option value='0' disabled selected>Select Product</option>";
		foreach ($products as $key => $product) {
			echo "<option value='". $product['product_id'] ."'>". ucwords($product['product_name']) . ' ' . $product['weight'] . ' ' . ucwords($product['product_unit']) . ' | Stock : ' . $product['amount'] . ' Pcs' ."</option>";
        }
	}
	
}