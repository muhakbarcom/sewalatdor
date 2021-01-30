<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Keranjang_model');
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'keranjang?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'keranjang?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'keranjang';
            $config['first_url'] = base_url() . 'keranjang';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Keranjang_model->total_rows($q);
        $keranjang = $this->Keranjang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'keranjang_data' => $keranjang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Keranjang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Keranjang' => '',
        ];

        $data['page'] = 'keranjang/keranjang_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Keranjang_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_keranjang' => $row->id_keranjang,
                'id_barang' => $row->id_barang,
                'jumlah' => $row->jumlah,
                'total_harga' => $row->total_harga,
            );
            $data['title'] = 'Keranjang';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'keranjang/keranjang_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('keranjang'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('keranjang/create_action'),
            'id_keranjang' => set_value('id_keranjang'),
            'id_barang' => set_value('id_barang'),
            'jumlah' => set_value('jumlah'),
            'total_harga' => set_value('total_harga'),
        );
        $data['title'] = 'Keranjang';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'keranjang/keranjang_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();
        $barang = $this->input->post('id_barang', TRUE);
        $jml_barang = $this->input->post('jumlah', TRUE);
        $harga_barang = $this->db->query("SELECT harga_sewa from barang where id_barang = $barang")->row();
        $total_harga = $harga_barang->harga_sewa * $jml_barang;
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data = array(
                'id_barang' => $this->input->post('id_barang', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'total_harga' => $total_harga,
            );

            $this->Keranjang_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('sewa/create'));
        }
    }

    public function update($id)
    {
        $row = $this->Keranjang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('keranjang/update_action'),
                'id_keranjang' => set_value('id_keranjang', $row->id_keranjang),
                'id_barang' => set_value('id_barang', $row->id_barang),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'total_harga' => set_value('total_harga', $row->total_harga),
            );
            $data['title'] = 'Keranjang';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];
            $data['barang'] = $this->db->query("select * from barang")->result();
            $data['page'] = 'keranjang/keranjang_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('sewa/create'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_keranjang', TRUE));
        } else {
            $data = array(
                'id_barang' => $this->input->post('id_barang', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'total_harga' => $this->input->post('total_harga', TRUE),
            );

            $this->Keranjang_model->update($this->input->post('id_keranjang', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('sewa/create'));
        }
    }

    public function delete($id)
    {
        $row = $this->Keranjang_model->get_by_id($id);

        if ($row) {
            $this->Keranjang_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('sewa/create'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('sewa/create'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Keranjang_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('total_harga', 'total harga', 'trim');

        $this->form_validation->set_rules('id_keranjang', 'id_keranjang', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "keranjang.xls";
        $judul = "keranjang";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Harga");

        foreach ($this->Keranjang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_harga);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=keranjang.doc");

        $data = array(
            'keranjang_data' => $this->Keranjang_model->get_all(),
            'start' => 0
        );

        $this->load->view('keranjang/keranjang_doc', $data);
    }

    public function printdoc()
    {
        $data = array(
            'keranjang_data' => $this->Keranjang_model->get_all(),
            'start' => 0
        );
        $this->load->view('keranjang/keranjang_print', $data);
    }
}

/* End of file Keranjang.php */
/* Location: ./application/controllers/Keranjang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-29 03:56:19 */
/* http://harviacode.com */