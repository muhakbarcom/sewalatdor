<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->model('Member_model');
		$this->load->model('Sewa_model');
		$this->load->model('Barang_model');
	}

	public function index()
	{
		$data['member'] = $this->Member_model->total_member();
		$data['sewa'] = $this->Sewa_model->total_sewa();
		$data['barang'] = $this->Barang_model->total_barang();
		$data['pendapatan'] = $this->Sewa_model->total_pendapatan();
		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];
		//$this->layout->set_privilege(1);
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}
}
