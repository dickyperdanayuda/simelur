<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailPenyaluran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		$this->load->library('upload');
		$this->load->model('Model_Penyaluran', 'penyaluran');
		$this->load->model('Model_Detail_Penyaluran', 'detail_penyaluran');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$this->session->set_userdata("judul", "Data Penyaluran");
		$ba = [
			'judul' => "Data Detail Penyaluran",
			'subjudul' => "Detail Penyaluran",
		];
		$penyaluran = $this->penyaluran->get_penyaluran();
		$d = [
				'penyaluran'=>$penyaluran,
			];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('detail_penyaluran', $d);
		$this->load->view('background_bawah');
	}

	public function ajax_list_detail_penyaluran()
	{
		$list = $this->detail_penyaluran->get_datatables();
		// var_dump($list);
		// exit();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $detail_penyaluran) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $detail_penyaluran->nama_penyaluran;
			$row[] = $detail_penyaluran->isi_penyaluran;
			$gmbr = $detail_penyaluran->gambar;
			$gbr = "<img src='" . base_url('assets/images/penyaluran/') . $gmbr . "' class='img' style='width:100px; height:100px;'>";
			$row[] = $gbr;
			
			$row[] = "<a href='#' onClick='hapus_detail(" . $detail_penyaluran->id_detail . ")' class='btn btn-danger btn-sm' title='Hapus data pengguna'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->detail_penyaluran->count_all(),
			"recordsFiltered" => $this->detail_penyaluran->count_filtered(),
			"data" => $data,
			"query" => $this->detail_penyaluran->getlastquery(),
		);
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('id_detail');
		$data = $this->detail_penyaluran->cari_penyaluran($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('id_detail');
		$id_penyalurandt = $this->input->post('id_penyalurandt');
		$gambar = $this->input->post('gambar');
		$nama = date('Ymdhis');
		// $next = $id_penyalurandt +1;
		// $nama = $today.sprintf('%04s',$next);
		// var_dump($nama);
		// exit();
		// $nama = "Penyaluran";

		if (!empty($_FILES['gambar']['name'])) {
			$filename = $_FILES['gambar']['name'];
			$arrName = explode(".", $filename);
			$idxName = count($arrName);
			$ext = $arrName[$idxName - 1];
			$config['upload_path'] = 'assets/images/penyaluran/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|webp'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
			$config['overwrite'] = TRUE; //Enkripsi nama yang terupload
			$config['file_name'] = $nama . "." . $ext; //ganti nama file
			$this->upload->initialize($config);
		}
		if (!is_dir('assets/images/penyaluran')) {
			mkdir('assets/images/penyaluran', 0777, TRUE);
			mkdir('assets/images/penyaluran/thumbs', 0777, TRUE);
		}
		if (!empty($_FILES['gambar']['name'])) {
			if ($this->upload->do_upload('gambar')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'assets/images/penyaluran/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '50%';
				$config['width'] = 150;
				$config['height'] = 150;
				$config['new_image'] = 'assets/images/penyaluran/thumbs/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$foto = $gbr['file_name'];
			}
			$data = array(
			
			'id_penyalurandt' => $id_penyalurandt,
			'gambar' => $foto,
			
			);
			// var_dump($data);
			// exit();

		}else{
			
			$data = array(
			
			'id_penyalurandt' => $id_penyalurandt,			
			);
		}
		


		if ($id == 0) {
			
			$insert = $this->penyaluran->simpan("detail_penyaluran", $data);
		} else {
			
			$insert = $this->penyaluran->update("detail_penyaluran", array('id_detail' => $id), $data);
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
		// var_dump($id);
		// exit();
		$delete = $this->detail_penyaluran->delete('detail_penyaluran', 'id_detail', $id);

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
