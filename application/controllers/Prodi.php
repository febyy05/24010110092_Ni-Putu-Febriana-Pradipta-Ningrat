<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user')) {
            redirect('auth', 'refresh');
        }

        $this->load->model('ProdiModel');
    }

    public function index()
    {
        $dataView['listProdi'] = $this->ProdiModel->getAll();

        $header['title'] = 'Program Studi';

        $this->load->view('layout/header', $header);
        $this->load->view('prodi/index', $dataView);
        $this->load->view('layout/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric');
            $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');
            $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('prodi_strata', 'Strata', 'required');

            if ($this->form_validation->run() === TRUE) {

                $inputData = $this->input->post();

                $dataSimpan = [
                    'prodi_id'     => $inputData['prodi_id'],
                    'fakultas_id'  => $inputData['fakultas_id'],
                    'prodi_name'   => $inputData['prodi_name'],
                    'prodi_strata' => $inputData['prodi_strata']
                ];

                $this->ProdiModel->insert($dataSimpan);

                $this->session->set_flashdata('swal', [
                    'icon'  => 'success',
                    'title' => 'Berhasil!',
                    'text'  => 'Data berhasil ditambahkan.'
                ]);

                redirect('prodi');
            }
        }

        $dataView['listProdi'] = null;
        $dataView['listFakultas'] = $this->ProdiModel->getFakultas();
        $dataView['action'] = base_url('prodi/tambah');
        $dataView['button'] = 'Simpan';

        $header['title'] = 'Tambah Data Program Studi';

        $this->load->view('layout/header', $header);
        $this->load->view('prodi/form', $dataView);
        $this->load->view('layout/footer');
    }

    public function ubah($idProdi)
    {
        $detailProdi = $this->ProdiModel->getById($idProdi);

        if (!$detailProdi) {

            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Program Studi tidak ditemukan.'
            ]);

            redirect('prodi');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric');
            $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');
            $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('prodi_strata', 'Strata', 'required');

            if ($this->form_validation->run() === TRUE) {

                $inputData = $this->input->post();

                $dataUpdate = [
                    'prodi_id'     => $inputData['prodi_id'],
                    'fakultas_id'  => $inputData['fakultas_id'],
                    'prodi_name'   => $inputData['prodi_name'],
                    'prodi_strata' => $inputData['prodi_strata']
                ];

                $this->ProdiModel->update($idProdi, $dataUpdate);

                $this->session->set_flashdata('swal', [
                    'icon'  => 'success',
                    'title' => 'Berhasil!',
                    'text'  => 'Data berhasil diupdate.'
                ]);

                redirect('prodi');
            }

            $detailProdi = $this->input->post();
        }

        $dataView['listProdi'] = $detailProdi;
        $dataView['listFakultas'] = $this->ProdiModel->getFakultas();
        $dataView['action'] = base_url('prodi/ubah/'.$idProdi);
        $dataView['button'] = 'Update';

        $header['title'] = 'Ubah Program Studi';

        $this->load->view('layout/header', $header);
        $this->load->view('prodi/form', $dataView);
        $this->load->view('layout/footer');
    }

    public function hapus($idProdi)
    {
        $detailProdi = $this->ProdiModel->getById($idProdi);

        if (!$detailProdi) {

            $this->session->set_flashdata('swal', [
                'icon'  => 'warning',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Program studi tidak ditemukan.'
            ]);

            redirect('prodi');
        }

        $this->ProdiModel->delete($idProdi);

        $this->session->set_flashdata('swal', [
            'icon'  => 'success',
            'title' => 'Dihapus!',
            'text'  => 'Data berhasil dihapus.'
        ]);

        redirect('prodi');
    }
}