<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Member_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'member?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'member?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'member';
            $config['first_url'] = base_url() . 'member';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Member_model->total_rows($q);
        $member = $this->Member_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'member_data' => $member,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Member';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Member' => '',
        ];

        $data['page'] = 'member/member_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Member_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_member' => $row->id_member,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'scan_jaminan' => $row->scan_jaminan,
            );
            $data['title'] = 'Member';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'member/member_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('member'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('member/create_action'),
            'id_member' => set_value('id_member'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'scan_jaminan' => set_value('scan_jaminan'),
        );
        $data['title'] = 'Member';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'member/member_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $scan_jaminan = $_FILES['scan_jaminan'];
            if ($scan_jaminan == '') {
            } else {
                $config['upload_path'] = './assets/uploads/image/jaminan/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('scan_jaminan')) {

                    $scan_jaminan = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('setting');
                }
            }
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'scan_jaminan' => $scan_jaminan,
            );

            $this->Member_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('member'));
        }
    }

    public function update($id)
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('member/update_action'),
                'id_member' => set_value('id_member', $row->id_member),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'scan_jaminan' => set_value('scan_jaminan', $row->scan_jaminan),
            );
            $data['title'] = 'Member';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'member/member_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('member'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        $data['s_aplikasi'] = $this->Member_model->get_by_id($this->input->post('id_member', TRUE));
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_member', TRUE));
        } else {
            $scan_jaminan = $_FILES['scan_jaminan'];
            if ($scan_jaminan == '') {
            } else {
                $config['upload_path'] = './assets/uploads/image/jaminan/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('scan_jaminan')) {
                    $old_image = $data['s_aplikasi']->scan_jaminan;
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/uploads/image/jaminan/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('scan_jaminan', $new_image);
                }
            }
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                // 'scan_jaminan' => $this->input->post('scan_jaminan', TRUE),
            );

            $this->Member_model->update($this->input->post('id_member', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('member'));
        }
    }

    public function delete($id)
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $this->Member_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('member'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('member'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Member_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        // $this->form_validation->set_rules('scan_jaminan', 'scan jaminan', 'trim|required');

        $this->form_validation->set_rules('id_member', 'id_member', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "member.xls";
        $judul = "member";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Scan Jaminan");

        foreach ($this->Member_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->scan_jaminan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=member.doc");

        $data = array(
            'member_data' => $this->Member_model->get_all(),
            'start' => 0
        );

        $this->load->view('member/member_doc', $data);
    }

    public function printdoc()
    {
        $data = array(
            'member_data' => $this->Member_model->get_all(),
            'start' => 0
        );
        $this->load->view('member/member_print', $data);
    }
}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-20 02:51:27 */
/* http://harviacode.com */