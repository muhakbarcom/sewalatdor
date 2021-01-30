<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_sewa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Detail_sewa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'detail_sewa?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'detail_sewa?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'detail_sewa';
            $config['first_url'] = base_url() . 'detail_sewa';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Detail_sewa_model->total_rows($q);
        $detail_sewa = $this->Detail_sewa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'detail_sewa_data' => $detail_sewa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Detail Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Detail Sewa' => '',
        ];

        $data['page'] = 'detail_sewa/detail_sewa_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Detail_sewa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_detail_sewa' => $row->id_detail_sewa,
		'id_sewa' => $row->id_sewa,
		'id_barang' => $row->id_barang,
		'jumlah_barang' => $row->jumlah_barang,
		'total_harga_sewa' => $row->total_harga_sewa,
	    );
        $data['title'] = 'Detail Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'detail_sewa/detail_sewa_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('detail_sewa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_sewa/create_action'),
	    'id_detail_sewa' => set_value('id_detail_sewa'),
	    'id_sewa' => set_value('id_sewa'),
	    'id_barang' => set_value('id_barang'),
	    'jumlah_barang' => set_value('jumlah_barang'),
	    'total_harga_sewa' => set_value('total_harga_sewa'),
	);
        $data['title'] = 'Detail Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'detail_sewa/detail_sewa_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_sewa' => $this->input->post('id_sewa',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'jumlah_barang' => $this->input->post('jumlah_barang',TRUE),
		'total_harga_sewa' => $this->input->post('total_harga_sewa',TRUE),
	    );

            $this->Detail_sewa_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('detail_sewa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Detail_sewa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_sewa/update_action'),
		'id_detail_sewa' => set_value('id_detail_sewa', $row->id_detail_sewa),
		'id_sewa' => set_value('id_sewa', $row->id_sewa),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'jumlah_barang' => set_value('jumlah_barang', $row->jumlah_barang),
		'total_harga_sewa' => set_value('total_harga_sewa', $row->total_harga_sewa),
	    );
            $data['title'] = 'Detail Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'detail_sewa/detail_sewa_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('detail_sewa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_detail_sewa', TRUE));
        } else {
            $data = array(
		'id_sewa' => $this->input->post('id_sewa',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'jumlah_barang' => $this->input->post('jumlah_barang',TRUE),
		'total_harga_sewa' => $this->input->post('total_harga_sewa',TRUE),
	    );

            $this->Detail_sewa_model->update($this->input->post('id_detail_sewa', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('detail_sewa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Detail_sewa_model->get_by_id($id);

        if ($row) {
            $this->Detail_sewa_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('detail_sewa'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('detail_sewa'));
        }
    }

    public function deletebulk(){
        $delete = $this->Detail_sewa_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_sewa', 'id sewa', 'trim|required');
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'trim|required');
	$this->form_validation->set_rules('total_harga_sewa', 'total harga sewa', 'trim|required');

	$this->form_validation->set_rules('id_detail_sewa', 'id_detail_sewa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "detail_sewa.xls";
        $judul = "detail_sewa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Sewa");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Harga Sewa");

	foreach ($this->Detail_sewa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_sewa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_harga_sewa);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=detail_sewa.doc");

        $data = array(
            'detail_sewa_data' => $this->Detail_sewa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('detail_sewa/detail_sewa_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'detail_sewa_data' => $this->Detail_sewa_model->get_all(),
            'start' => 0
        );
        $this->load->view('detail_sewa/detail_sewa_print', $data);
    }

}

/* End of file Detail_sewa.php */
/* Location: ./application/controllers/Detail_sewa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-29 03:41:20 */
/* http://harviacode.com */