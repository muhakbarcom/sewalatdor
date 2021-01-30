<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sewa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Sewa_model');
        $this->load->model('Barang_model');
        $this->load->model('Detail_sewa_model');
        $this->load->model('Keranjang_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Sewa' => '',
        ];

        $data['page'] = 'sewa/sewa_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Sewa_model->json();
    }

    public function read($id)
    {
        $row = $this->Sewa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_sewa' => $row->id_sewa,
                'id_member' => $row->id_member,
                'id_user' => $row->id_user,
                'tgl_sewa' => $row->tgl_sewa,
                'tgl_kembali' => $row->tgl_kembali,
                'tgl_pengembalian' => $row->tgl_pengembalian,
                'denda' => $row->denda,
                'total_bayar' => $row->total_bayar,
                'status' => $row->status,
            );
            $data['title'] = 'Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'sewa/sewa_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('sewa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Masukan ke Keranjang',
            'action' => site_url('keranjang/create_action'),
            'id_sewa' => set_value('id_sewa'),
            'id_member' => set_value('id_member'),
            'id_user' => set_value('id_user'),
            'tgl_sewa' => set_value('tgl_sewa'),
            'tgl_kembali' => set_value('tgl_kembali'),
            'tgl_pengembalian' => set_value('tgl_pengembalian'),
            'denda' => set_value('denda'),
            'total_bayar' => set_value('total_bayar'),
            'status' => set_value('status'),
        );
        $data['title'] = 'Sewa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['member'] = $this->db->query("select id_member, nama from member")->result();
        $data['keranjang'] = $this->db->query("select * from keranjang")->result();
        $data['barang'] = $this->db->query("select * from barang")->result();
        $data['user'] = $this->db->query("select id, first_name, last_name from users")->result();
        $data['page'] = 'sewa/sewa_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // ambil data keranjang
            $keranjang_row = $this->db->query("SELECT sum(total_harga) as total from keranjang")->row();
            // insert data sewa
            $data = array(
                'id_member' => $this->input->post('id_member', TRUE),
                'id_user' => $this->input->post('id_user', TRUE),
                'tgl_sewa' => $this->input->post('tgl_sewa', TRUE),
                'tgl_kembali' => $this->input->post('tgl_kembali', TRUE),
                // 'tgl_pengembalian' => $this->input->post('tgl_pengembalian', TRUE),
                // 'denda' => $this->input->post('denda', TRUE),
                'total_bayar' => $keranjang_row->total,
                'status' => 'dipinjam',
            );
            $insert_id = $this->Sewa_model->insert($data);


            // insert data detail_sewa
            $keranjang = $this->Keranjang_model->get_all();
            foreach ($keranjang as $k) {
                $data = array(
                    'id_sewa' => $insert_id,
                    'id_barang' => $k->id_barang,
                    'jumlah_barang' => $k->jumlah,
                    'total_harga_sewa' => $k->total_harga,
                );
                $this->Detail_sewa_model->insert($data);
            }

            $this->Keranjang_model->delete_all();

            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('view_sewa'));
        }
    }

    public function update($id)
    {
        $row = $this->Sewa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sewa/update_action'),
                'id_sewa' => set_value('id_sewa', $row->id_sewa),
                'id_member' => set_value('id_member', $row->id_member),
                'id_user' => set_value('id_user', $row->id_user),
                'tgl_sewa' => set_value('tgl_sewa', $row->tgl_sewa),
                'tgl_kembali' => set_value('tgl_kembali', $row->tgl_kembali),
                'tgl_pengembalian' => set_value('tgl_pengembalian', $row->tgl_pengembalian),
                'denda' => set_value('denda', $row->denda),
                'total_bayar' => set_value('total_bayar', $row->total_bayar),
                'status' => set_value('status', $row->status),
            );
            $data['title'] = 'Sewa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'sewa/sewa_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('sewa'));
        }
    }

    public function kembalikan($id)
    {
        $total_bayar = $this->db->query("SELECT total_bayar from sewa where id_sewa= $id")->row();
        $denda = $this->denda($id);
        $data = array(
            'tgl_pengembalian' => date('Y-m-d'),
            'denda' => $denda,
            'status' => 'kembali',
            'total_bayar' => $total_bayar->total_bayar + $denda

        );

        $this->Sewa_model->update($id, $data);
        $this->session->set_flashdata('success', 'Update Record Success');
        redirect(site_url('view_sewa'));
    }

    public function denda($id)
    {
        $id = $id;
        $tgl_kembali = $this->db->query("SELECT tgl_kembali from sewa where id_sewa= $id")->row();
        $selisih = strtotime($tgl_kembali->tgl_kembali) - strtotime(date('Y-m-d'));
        $selisih = $selisih / 86400;
        if ($selisih < 0) {
            return abs($selisih * 10000);
        } else {
            return "0";
        }
    }


    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sewa', TRUE));
        } else {
            $data = array(
                'id_member' => $this->input->post('id_member', TRUE),
                'id_user' => $this->input->post('id_user', TRUE),
                'tgl_sewa' => $this->input->post('tgl_sewa', TRUE),
                'tgl_kembali' => $this->input->post('tgl_kembali', TRUE),
                'tgl_pengembalian' => $this->input->post('tgl_pengembalian', TRUE),
                'denda' => $this->input->post('denda', TRUE),
                'total_bayar' => $this->input->post('total_bayar', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Sewa_model->update($this->input->post('id_sewa', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('sewa'));
        }
    }

    public function delete($id)
    {
        $row = $this->Sewa_model->get_by_id($id);

        if ($row) {
            $this->Sewa_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('sewa'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('sewa'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Sewa_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_member', 'Member Peminjam', 'trim|required');
        $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
        $this->form_validation->set_rules('tgl_sewa', 'tgl sewa', 'trim|required');
        $this->form_validation->set_rules('tgl_kembali', 'tgl kembali', 'trim|required');
        // $this->form_validation->set_rules('tgl_pengembalian', 'tgl pengembalian', 'trim|required');
        // $this->form_validation->set_rules('denda', 'denda', 'trim|required');
        // $this->form_validation->set_rules('total_bayar', 'total bayar', 'trim|required');
        // $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id_sewa', 'id_sewa', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sewa.xls";
        $judul = "sewa";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Member");
        xlsWriteLabel($tablehead, $kolomhead++, "Id User");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Sewa");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kembali");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pengembalian");
        xlsWriteLabel($tablehead, $kolomhead++, "Denda");
        xlsWriteLabel($tablehead, $kolomhead++, "Total Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Sewa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_member);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_sewa);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_kembali);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pengembalian);
            xlsWriteNumber($tablebody, $kolombody++, $data->denda);
            xlsWriteNumber($tablebody, $kolombody++, $data->total_bayar);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sewa.doc");

        $data = array(
            'sewa_data' => $this->Sewa_model->get_all(),
            'start' => 0
        );

        $this->load->view('sewa/sewa_doc', $data);
    }

    public function printdoc()
    {
        $data = array(
            'sewa_data' => $this->Sewa_model->get_all(),
            'start' => 0
        );
        $this->load->view('sewa/sewa_print', $data);
    }
}

/* End of file Sewa.php */
/* Location: ./application/controllers/Sewa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-19 03:44:18 */
/* http://harviacode.com */