<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyaluran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		if ($this->session->userdata("level") > 2) {
			redirect(base_url("Dashboard"));
		}
		$this->load->model('Model_Penyaluran', 'penyaluran');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$this->session->set_userdata("judul", "Data Penyaluran");
		$ba = [
			'judul' => "Data Penyaluran",
			'subjudul' => "Penyaluran",
		];
		$d = [];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('penyaluran', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_penyaluran()
	{
		$list = $this->penyaluran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penyaluran) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $penyaluran->tgl_penyaluran;
			$row[] = $penyaluran->nama_penyaluran;
			$row[] = $penyaluran->isi_penyaluran;
			
			$row[] = "<a href='#' onClick='ubah_penyaluran(" . $penyaluran->id_penyaluran . ")' class='btn btn-info btn-sm' title='Ubah data pengguna'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' onClick='hapus_penyaluran(" . $penyaluran->id_penyaluran . ")' class='btn btn-danger btn-sm' title='Hapus data pengguna'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->penyaluran->count_all(),
			"recordsFiltered" => $this->penyaluran->count_filtered(),
			"data" => $data,
			"query" => $this->penyaluran->getlastquery(),
		);
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('id_penyaluran');
		$data = $this->penyaluran->cari_penyaluran($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('id_penyaluran');
		$tgls = explode("/", $this->input->post('tgl_penyaluran'));
		$tgl_penyaluran = "{$tgls[2]}-{$tgls[1]}-{$tgls[0]}";

		// $tglx = $this->input->post('tgl_penyaluran');

		$nama_penyaluran = $this->input->post('nama_penyaluran');
		$isi_penyaluran = $this->input->post('isi_penyaluran');
		
		if ($id == 0) {
			$data = array(
				'tgl_penyaluran' => $tgl_penyaluran,
				'nama_penyaluran' => $nama_penyaluran,
				'isi_penyaluran' => $isi_penyaluran
			);
			$insert = $this->penyaluran->simpan("penyaluran", $data);
		} else {
			$data = array(
				'tgl_penyaluran' => $tgl_penyaluran,
				'nama_penyaluran' => $nama_penyaluran,
				'isi_penyaluran' => $isi_penyaluran
			);
			$insert = $this->penyaluran->update("penyaluran", array('id_penyaluran' => $id), $data);
		}
		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}
		if ($insert) {
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}

	public function hapus($id)
	{
		$delete = $this->penyaluran->delete('penyaluran', 'id_penyaluran', $id);

		if ($delete) {
			$resp['status'] = 1;
			$resp['desc'] = "<i class='fa fa-check-circle text-success'></i>&nbsp;&nbsp;&nbsp; Berhasil menghapus data";
		} else {
			$resp['status'] = 0;
			$resp['desc'] = "<i class='fa fa-exclamation-circle text-danger'></i>&nbsp;&nbsp;&nbsp;Gagal menghapus data !";
		}
		echo json_encode($resp);
	}
}
