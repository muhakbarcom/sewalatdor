<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View_detail_sewa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('View_detail_sewa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'view_detail_sewa?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'view_detail_sewa?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'view_detail_sewa';
            $config['first_url'] = base_url() . 'view_detail_sewa';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->View_detail_sewa_model->total_rows($q);
        $view_detail_sewa = $this->View_detail_sewa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'view_detail_sewa_data' => $view_detail_sewa,
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

        $data['page'] = 'view_detail_sewa/view_detail_sewa_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $data['row'] = $this->View_detail_sewa_model->get_by_id($id);
        if ($data['row']) {
            $data['title'] = 'View Detail Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'view_detail_sewa/view_detail_sewa_read';
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
            'action' => site_url('view_detail_sewa/create_action'),
            'nama_barang' => set_value('nama_barang'),
            'harga_sewa' => set_value('harga_sewa'),
            'jumlah_barang' => set_value('jumlah_barang'),
            'total_harga_sewa' => set_value('total_harga_sewa'),
        );
        $data['title'] = 'View Detail Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'view_detail_sewa/view_detail_sewa_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'harga_sewa' => $this->input->post('harga_sewa', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'total_harga_sewa' => $this->input->post('total_harga_sewa', TRUE),
            );

            $this->View_detail_sewa_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('view_detail_sewa'));
        }
    }

    public function update($id)
    {
        $row = $this->View_detail_sewa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('view_detail_sewa/update_action'),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'harga_sewa' => set_value('harga_sewa', $row->harga_sewa),
                'jumlah_barang' => set_value('jumlah_barang', $row->jumlah_barang),
                'total_harga_sewa' => set_value('total_harga_sewa', $row->total_harga_sewa),
            );
            $data['title'] = 'View Detail Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'view_detail_sewa/view_detail_sewa_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('view_detail_sewa'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'harga_sewa' => $this->input->post('harga_sewa', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'total_harga_sewa' => $this->input->post('total_harga_sewa', TRUE),
            );

            $this->View_detail_sewa_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('view_detail_sewa'));
        }
    }

    public function delete($id)
    {
        $row = $this->View_detail_sewa_model->get_by_id($id);

        if ($row) {
            $this->View_detail_sewa_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('view_detail_sewa'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('view_detail_sewa'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->View_detail_sewa_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
        $this->form_validation->set_rules('harga_sewa', 'harga sewa', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'trim|required');
        $this->form_validation->set_rules('total_harga_sewa', 'total harga sewa', 'trim|required');

        $this->form_validation->set_rules('', '', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file View_detail_sewa.php */
/* Location: ./application/controllers/View_detail_sewa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-30 16:45:45 */
/* http://harviacode.com */