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
		$this->load->model('Customer_model', 'customer');
		$this->load->model('Supplier_model', 'supplier');
		$this->load->model('Stock_product_model', 'stock_product');
		$this->load->model('Stock_out_product_model', 'stock_out_product');
		$this->load->model('Stock_out_product_detail_model', 'stock_out_product_detail');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        $data = [
            'title'         => 'Stock Out Product',
			'products'		=> $this->stock_product->get_stock_products(),
			'customers'		=> $this->customer->get_customers()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('stock_out_products/index');
        $this->load->view('templates/footer');
    }

	public function add_to_cart()
	{
		$product_id = $this->input->post('product');
		$products = $this->product->get_product_by_product_id($product_id);
		$stock_products = $this->stock_product->get_stock_products_by_product_id($product_id);
		$qty = $this->input->post('amount');

		$amount_product = $stock_products['amount'];

		if ($qty > $amount_product) {
			$this->session->set_flashdata('flash', "<script>Swal.fire({icon: 'error', title: 'Failed...', text: 'Out of Stocks!'})</script>");

        	redirect('stock_out_product');
		} else {
			$data = [
				'id'						=> $stock_products['id'],
				'name'						=> $products['product_name'],
				'product_id'				=> $product_id,
				'product_unit'				=> $products['product_unit'],
				'weight'					=> $products['weight'],
				'cost_of_goods'				=> $products['cost_of_goods'],
				'selling_price_of_goods'	=> $products['selling_price_of_goods'],
				'qty'						=> $qty,
				'price'						=> $products['selling_price_of_goods']
			];
	
			$this->cart->insert($data);
	
			redirect('stock_out_product');
		}

	}
	public function update_qty()
	{
		$product_id = $this->input->post('product_id');
		$stock_products = $this->stock_product->get_stock_products_by_product_id($product_id);
		$qty = $this->input->post('qty');

		$amount_product = $stock_products['amount'];

		if ($qty > $amount_product) {
			$this->session->set_flashdata('flash', "<script>Swal.fire({icon: 'error', title: 'Failed...', text: 'Out of Stocks!'})</script>");

        	redirect('stock_out_product');
		} else {
		$row_id = $this->input->post('rowId');
		$qty = $this->input->post('qty');
		$this->cart->update([
				'rowid' => $row_id,
				'qty'   => $qty
			]);
		}
		redirect('stock_out_product');
	}

	public function checkout()
	{
		if($this->input->post('total_price') == 0) {
			$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'The cart is empty!',showConfirmButton: false,timer: 1500})</script>");

        	redirect('stock_out_product');
		}

		$no_transaction = $this->stock_out_product->get_no_transaction();
		$total_price = $this->input->post('total_price');
		$customer_id = $this->input->post('customer');
		$payment = $this->input->post('payment');
		$paid = '0';
		$ppn = $this->input->post('ppn');
		$ttd = '0';
		$materai = '0';

		if($this->input->post('shipping') == NULL) {
			$shipping = '0';
			$amount_shipping = '0';
		} else {
			$shipping = '1';
			$amount_shipping = $this->input->post('shipping');
		}

		$created_at = date('Y-m-d H:i:s');

		$data = [
			'no_transaction'	=> $no_transaction,
			'total_price'		=> $total_price,
			'customer_id'		=> $customer_id,
			'payment'			=> $payment,
			'paid'				=> $paid,
			'ppn'				=> $ppn,
			'ttd'				=> $ttd,
			'materai'			=> $materai,
			'shipping'			=> $shipping,
			'amount_shipping'	=> $amount_shipping,
			'created_at'		=> $created_at,
		];

		$this->stock_out_product->insert_stock_out_product($data);

		foreach ( $this->cart->contents() as $item ) {
			$cart = [
				'no_transaction'			=> $no_transaction,
				'product_id'				=> $item['id'],
				'cost_of_goods'				=> $item['cost_of_goods'],
				'selling_price_of_goods'	=> $item['selling_price_of_goods'],
				'amount'					=> $item['qty'],
				'price_subtotal'			=> $item['qty']*$item['price'],
				'created_at'				=> date('Y-m-d H:i:s')
			];

			$this->stock_out_product_detail->insert_stock_out_product_detail($cart);
		}

		$this->cart->destroy();

		$this->session->set_flashdata('flash', "<script>Swal.fire({position: 'top-end',icon: 'error',title: 'Success!',showConfirmButton: false,timer: 1500})</script>");

        redirect('stock_out_product');

	}

	public function remove()
	{
		$row_id = $this->uri->segment(3);

		$this->cart->update([
			'rowid' => $row_id,
			'qty'   => 0
		]);

		$this->session->set_flashdata('msg',"<script>Swal.fire({position: 'top-end',icon: 'success',title: 'Success...',showConfirmButton: false,timer: 1500})</script>");

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