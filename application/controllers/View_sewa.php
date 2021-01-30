<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View_sewa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('View_sewa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'view_sewa?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'view_sewa?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'view_sewa';
            $config['first_url'] = base_url() . 'view_sewa';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->View_sewa_model->total_rows($q);
        $view_sewa = $this->View_sewa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'view_sewa_data' => $view_sewa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Sewa' => '',
        ];

        $data['page'] = 'view_sewa/view_sewa_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->View_sewa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'Nama_Peminjam' => $row->Nama_Peminjam,
                'Nama_Kasir' => $row->Nama_Kasir,
                'Tanggal_sewa' => $row->Tanggal_sewa,
                'Tanggal_kembali' => $row->Tanggal_kembali,
                'Tanggal_pengembalian' => $row->Tanggal_pengembalian,
                'Denda' => $row->Denda,
                'Total_bayar' => $row->Total_bayar,
                'STATUS' => $row->STATUS,
            );
            $data['title'] = 'View Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'view_sewa/view_sewa_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('view_sewa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('view_sewa/create_action'),
            'Nama_Peminjam' => set_value('Nama_Peminjam'),
            'Nama_Kasir' => set_value('Nama_Kasir'),
            'Tanggal_sewa' => set_value('Tanggal_sewa'),
            'Tanggal_kembali' => set_value('Tanggal_kembali'),
            'Tanggal_pengembalian' => set_value('Tanggal_pengembalian'),
            'Denda' => set_value('Denda'),
            'Total_bayar' => set_value('Total_bayar'),
            'STATUS' => set_value('STATUS'),
        );
        $data['title'] = 'View Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'view_sewa/view_sewa_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'Nama_Peminjam' => $this->input->post('Nama_Peminjam', TRUE),
                'Nama_Kasir' => $this->input->post('Nama_Kasir', TRUE),
                'Tanggal_sewa' => $this->input->post('Tanggal_sewa', TRUE),
                'Tanggal_kembali' => $this->input->post('Tanggal_kembali', TRUE),
                'Tanggal_pengembalian' => $this->input->post('Tanggal_pengembalian', TRUE),
                'Denda' => $this->input->post('Denda', TRUE),
                'Total_bayar' => $this->input->post('Total_bayar', TRUE),
                'STATUS' => $this->input->post('STATUS', TRUE),
            );

            $this->View_sewa_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('view_sewa'));
        }
    }

    public function update($id)
    {
        $row = $this->View_sewa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('view_sewa/update_action'),
                'Nama_Peminjam' => set_value('Nama_Peminjam', $row->Nama_Peminjam),
                'Nama_Kasir' => set_value('Nama_Kasir', $row->Nama_Kasir),
                'Tanggal_sewa' => set_value('Tanggal_sewa', $row->Tanggal_sewa),
                'Tanggal_kembali' => set_value('Tanggal_kembali', $row->Tanggal_kembali),
                'Tanggal_pengembalian' => set_value('Tanggal_pengembalian', $row->Tanggal_pengembalian),
                'Denda' => set_value('Denda', $row->Denda),
                'Total_bayar' => set_value('Total_bayar', $row->Total_bayar),
                'STATUS' => set_value('STATUS', $row->STATUS),
            );
            $data['title'] = 'View Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'view_sewa/view_sewa_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('view_sewa'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
                'Nama_Peminjam' => $this->input->post('Nama_Peminjam', TRUE),
                'Nama_Kasir' => $this->input->post('Nama_Kasir', TRUE),
                'Tanggal_sewa' => $this->input->post('Tanggal_sewa', TRUE),
                'Tanggal_kembali' => $this->input->post('Tanggal_kembali', TRUE),
                'Tanggal_pengembalian' => $this->input->post('Tanggal_pengembalian', TRUE),
                'Denda' => $this->input->post('Denda', TRUE),
                'Total_bayar' => $this->input->post('Total_bayar', TRUE),
                'STATUS' => $this->input->post('STATUS', TRUE),
            );

            $this->View_sewa_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('view_sewa'));
        }
    }

    public function delete($id)
    {
        $row = $this->View_sewa_model->get_by_id($id);

        if ($row) {
            $this->View_sewa_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('view_sewa'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('view_sewa'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->View_sewa_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('Nama_Peminjam', 'nama peminjam', 'trim|required');
        $this->form_validation->set_rules('Nama_Kasir', 'nama kasir', 'trim|required');
        $this->form_validation->set_rules('Tanggal_sewa', 'tanggal sewa', 'trim|required');
        $this->form_validation->set_rules('Tanggal_kembali', 'tanggal kembali', 'trim|required');
        $this->form_validation->set_rules('Tanggal_pengembalian', 'tanggal pengembalian', 'trim|required');
        $this->form_validation->set_rules('Denda', 'denda', 'trim|required');
        $this->form_validation->set_rules('Total_bayar', 'total bayar', 'trim|required');
        $this->form_validation->set_rules('STATUS', 'status', 'trim|required');

        $this->form_validation->set_rules('', '', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file View_sewa.php */
/* Location: ./application/controllers/View_sewa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-30 16:45:48 */
/* http://harviacode.com */