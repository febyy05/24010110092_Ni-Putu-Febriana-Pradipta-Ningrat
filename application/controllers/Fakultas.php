<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user')) {
            redirect('auth');
        }

        $this->load->model('FakultasModel','fakultasDb');
    }

    public function index()
    {
        $dataView['listFakultas'] = $this->fakultasDb->getAll();

        $header['title'] = "Data Fakultas";

        $this->load->view('layout/header', $header);
        $this->load->view('fakultas/index', $dataView);
        $this->load->view('layout/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'fakultas_id',
                'ID Fakultas',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'fakultas_name',
                'Nama Fakultas',
                'required|min_length[4]|max_length[100]'
            );

            if ($this->form_validation->run()) {

                $inputData = $this->input->post();

                $dataSimpan = [
                    'fakultas_id'   => $inputData['fakultas_id'],
                    'fakultas_name' => $inputData['fakultas_name']
                ];

                $this->fakultasDb->insert($dataSimpan);

                $this->session->set_flashdata('swal', [
                    'icon'  => 'success',
                    'title' => 'Berhasil!',
                    'text'  => 'Data fakultas berhasil ditambahkan.'
                ]);

                redirect('fakultas');
            }
        }

        $dataView['dataFakultas'] = null;
        $dataView['action'] = base_url('fakultas/tambah');
        $dataView['button'] = 'Simpan';

        $header['title'] = 'Tambah Fakultas';

        $this->load->view('layout/header', $header);
        $this->load->view('fakultas/form', $dataView);
        $this->load->view('layout/footer');
    }

    public function ubah($id)
    {
        $detailFakultas = $this->fakultasDb->getById($id);

        if (empty($detailFakultas)) {

            $this->session->set_flashdata('swal', [
                'icon'  => 'error',
                'title' => 'Tidak Ditemukan!',
                'text'  => 'Data yang dicari tidak tersedia.'
            ]);

            redirect('fakultas');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'fakultas_id',
                'ID Fakultas',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'fakultas_name',
                'Nama Fakultas',
                'required|min_length[3]|max_length[100]'
            );

            if ($this->form_validation->run() === TRUE) {

                $inputData = $this->input->post();

                $dataUpdate = [
                    'fakultas_id'   => $inputData['fakultas_id'],
                    'fakultas_name' => $inputData['fakultas_name']
                ];

               $this->fakultasDb->update($id, $dataUpdate);

               $this->session->set_flashdata('swal', [
                    'icon'  => 'success',
                    'title' => 'Berhasil!',
                    'text'  => 'Data fakultas berhasil diupdate.'
                ]);

                redirect('fakultas');
            }

            $detailFakultas = $this->input->post();
        }

        $dataView['dataFakultas'] = $detailFakultas;
        $dataView['action'] = base_url('fakultas/ubah/' . $id);
        $dataView['button'] = 'Update';

        $header['title'] = 'Edit Fakultas';

        $this->load->view('layout/header', $header);
        $this->load->view('fakultas/form', $dataView);
        $this->load->view('layout/footer');
    }

    public function hapus($id)
    {
        $cekData = $this->fakultasDb->getById($id);

        if (!$cekData) {

         $this->session->set_flashdata('swal', [
                'icon'  => 'error',
                'title' => 'Gagal Ditemukan!',
                'text'  => 'Data tidak ditemukan.'
            ]);

            redirect('fakultas');
        }

        $this->fakultasDb->delete($id);

        $this->session->set_flashdata('swal', [
            'icon'  => 'success',
            'title' => 'Dihapus!',
            'text'  => 'Data berhasil dohapus.'
        ]);

        redirect('fakultas');
    }
}