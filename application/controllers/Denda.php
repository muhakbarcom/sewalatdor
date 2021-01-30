<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Denda extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Denda_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Denda';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Denda' => '',
        ];

        $data['page'] = 'denda/denda_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Denda_model->json();
    }

    public function read($id) 
    {
        $row = $this->Denda_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_denda' => $row->id_denda,
		'denda' => $row->denda,
	    );
        $data['title'] = 'Denda';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'denda/denda_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('denda'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('denda/create_action'),
	    'id_denda' => set_value('id_denda'),
	    'denda' => set_value('denda'),
	);
        $data['title'] = 'Denda';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'denda/denda_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'denda' => $this->input->post('denda',TRUE),
	    );

            $this->Denda_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('denda'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Denda_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('denda/update_action'),
		'id_denda' => set_value('id_denda', $row->id_denda),
		'denda' => set_value('denda', $row->denda),
	    );
            $data['title'] = 'Denda';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'denda/denda_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('denda'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_denda', TRUE));
        } else {
            $data = array(
		'denda' => $this->input->post('denda',TRUE),
	    );

            $this->Denda_model->update($this->input->post('id_denda', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('denda'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Denda_model->get_by_id($id);

        if ($row) {
            $this->Denda_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('denda'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('denda'));
        }
    }

    public function deletebulk(){
        $delete = $this->Denda_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('denda', 'denda', 'trim|required');

	$this->form_validation->set_rules('id_denda', 'id_denda', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "denda.xls";
        $judul = "denda";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Denda");

	foreach ($this->Denda_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->denda);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=denda.doc");

        $data = array(
            'denda_data' => $this->Denda_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('denda/denda_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'denda_data' => $this->Denda_model->get_all(),
            'start' => 0
        );
        $this->load->view('denda/denda_print', $data);
    }

}

/* End of file Denda.php */
/* Location: ./application/controllers/Denda.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-19 03:43:47 */
/* http://harviacode.com */