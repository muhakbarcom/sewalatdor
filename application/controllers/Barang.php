<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Barang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Barang' => '',
        ];

        $data['page'] = 'barang/barang_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Barang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_barang' => $row->id_barang,
		'nama_barang' => $row->nama_barang,
		'harga_sewa' => $row->harga_sewa,
		'stok' => $row->stok,
	    );
        $data['title'] = 'Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'barang/barang_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_action'),
	    'id_barang' => set_value('id_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'harga_sewa' => set_value('harga_sewa'),
	    'stok' => set_value('stok'),
	);
        $data['title'] = 'Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'barang/barang_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'harga_sewa' => $this->input->post('harga_sewa',TRUE),
		'stok' => $this->input->post('stok',TRUE),
	    );

            $this->Barang_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'harga_sewa' => set_value('harga_sewa', $row->harga_sewa),
		'stok' => set_value('stok', $row->stok),
	    );
            $data['title'] = 'Barang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'barang/barang_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            $data = array(
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'harga_sewa' => $this->input->post('harga_sewa',TRUE),
		'stok' => $this->input->post('stok',TRUE),
	    );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function deletebulk(){
        $delete = $this->Barang_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('harga_sewa', 'harga sewa', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');

	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "barang.xls";
        $judul = "barang";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Sewa");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");

	foreach ($this->Barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_sewa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=barang.doc");

        $data = array(
            'barang_data' => $this->Barang_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('barang/barang_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'barang_data' => $this->Barang_model->get_all(),
            'start' => 0
        );
        $this->load->view('barang/barang_print', $data);
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-19 03:51:58 */
/* http://harviacode.com */