<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
	{
		parent:: __construct();
		if (!$this->session->userdata('username')) {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

  public function index() {
    $data['title'] = 'Dhasboard';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('admin/index');
    $this->load->view('templates/admin_footer'); 
  }

  // prakata
  public function prakata() {
    $data['prakata'] = $this->admin_model->getPrakata();
    $data['title'] = 'Prakata';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('admin/prakata', $data);
    $this->load->view('templates/admin_footer'); 
  }

  public function tambah_prakata() {
    $config['upload_path']          = './assets/backend/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1280;
		// $config['max_height']           = 570;
		// $config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('foto'))
		{
			$data = $this->upload->display_errors();
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
   			. $data . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/prakata');
		} else
		{
			$data['judul'] = $this->input->post('judul', TRUE);
      $data['nama'] = $this->input->post('nama', TRUE);
			$data['prakata'] = $this->input->post('prakata', TRUE);
			$data['foto'] = $this->upload->data('file_name');
			$data['created_at'] = time();

			$this->admin_model->tambah_prakata($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  		Prakata Berhasil <strong> DiTambahkan!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/prakata');
		}	
  }

  public function ubah_prakata()
	{
		$id_prakata = $this->input->post('id_prakata');
		$file = $this->db->get_where('prakata',['id_prakata' => $id_prakata])->row_array();

		$data = [
			'judul' => $this->input->post('judul', TRUE),
      'nama' => $this->input->post('nama', TRUE),
			'prakata' => $this->input->post('prakata', TRUE),
			'created_at' => time(),
		];

		// jika ada gambar yang diupload
		$upload_file = $_FILES['foto']['name'];
		
		if ($upload_file) {
			$config['upload_path']          = './assets/backend/images/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2048;
			// $config['max_width']            = 1280;
			// $config['max_height']           = 570;
			// $config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto'))	{
				$file_lama = $file['foto'];
					if($file_lama != 'default.jpg') {
						unlink(FCPATH . 'assets/backend/images/' . $file_lama);
					}
				$file_baru = $this->upload->data('file_name');
				$this->db->set('foto', $file_baru);
			} else
			{
				$data = $this->upload->display_errors();
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
					. $data . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('admin/prakata');
			}	
		}
		$this->db->where('id_prakata',$id_prakata);
    $this->db->update('prakata', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  		Prakata Berhasil<strong> Diubah!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		redirect('admin/prakata');
	}

  public function hapus_prakata($id_prakata)
	{
		$data = $this->admin_model->getDataByIdPrakata($id_prakata)->row();
		$foto ='./assets/backend/images/' . $data->foto;

		if (is_readable($foto) && unlink($foto)) {
			$this->admin_model->hapusPrakata($id_prakata);
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  		Prakata Berhasil<strong> Dihapus!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
			redirect('admin/prakata');
		} else {
			echo "Gagal";
		}
	}

  // Team
  public function team() {
    $data['team'] = $this->admin_model->getTeam();
    $data['title'] = 'Team';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('admin/team', $data);
    $this->load->view('templates/admin_footer'); 
  }

  public function tambah_team() {
    $config['upload_path']          = './assets/backend/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1280;
		// $config['max_height']           = 570;
		// $config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('foto'))
		{
			$data = $this->upload->display_errors();
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
   			. $data . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/team');
		} else
		{
      $data['nama'] = $this->input->post('nama', TRUE);
      $data['jabatan'] = $this->input->post('jabatan', TRUE);
			$data['twitter'] = $this->input->post('twitter', TRUE);
      $data['facebook'] = $this->input->post('facebook', TRUE);
      $data['instagram'] = $this->input->post('instagram', TRUE);
			$data['linkedin'] = $this->input->post('linkedin', TRUE);
			$data['foto'] = $this->upload->data('file_name');
			$data['created_at'] = time();

			$this->admin_model->tambah_team($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  		Team Berhasil <strong> DiTambahkan!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/team');
		}	
  }

  public function ubah_team()
	{
		$id_team = $this->input->post('id_team');
		$file = $this->db->get_where('team',['id_team' => $id_team])->row_array();

		$data = [
			'nama' => $this->input->post('nama', TRUE),
      'jabatan' => $this->input->post('jabatan', TRUE),
			'twitter' => $this->input->post('twitter', TRUE),
      'facebook' => $this->input->post('facebook', TRUE),
      'instagram' => $this->input->post('instagram', TRUE),
			'linkedin' => $this->input->post('linkedin', TRUE),
			'created_at' => time(),
		];

		// jika ada gambar yang diupload
		$upload_file = $_FILES['foto']['name'];
		
		if ($upload_file) {
			$config['upload_path']          = './assets/backend/images/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2048;
			// $config['max_width']            = 1280;
			// $config['max_height']           = 570;
			// $config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto'))	{
				$file_lama = $file['foto'];
					if($file_lama != 'default.jpg') {
						unlink(FCPATH . 'assets/backend/images/' . $file_lama);
					}
				$file_baru = $this->upload->data('file_name');
				$this->db->set('foto', $file_baru);
			} else
			{
				$data = $this->upload->display_errors();
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
					. $data . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');
				redirect('admin/team');
			}	
		}
		$this->db->where('id_team',$id_team);
    $this->db->update('team', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  		Team Berhasil<strong> Diubah!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		redirect('admin/team');
	}

  public function hapus_team($id_team)
	{
		$data = $this->admin_model->getDataByIdTeam($id_team)->row();
		$foto ='./assets/backend/images/' . $data->foto;

		if (is_readable($foto) && unlink($foto)) {
			$this->admin_model->hapusTeam($id_team);
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  		Team Berhasil<strong> Dihapus!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
			redirect('admin/team');
		} else {
			echo "Gagal";
		}
	}

  // berita
  public function berita() {
    // $data['berita'] = $this->admin_model->getBerita();
    $data['title'] = 'Berita';
    $this->load->view('templates/admin_header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('admin/berita', $data);
    $this->load->view('templates/admin_footer'); 
  }

  public function tambah_berita() {
    $config['upload_path']          = './assets/backend/images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		// $config['max_width']            = 1280;
		// $config['max_height']           = 570;
		// $config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('foto'))
		{
			$data = $this->upload->display_errors();
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
   			. $data . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/berita');
		} else
		{
			$data['judul'] = $this->input->post('judul', TRUE);
			$data['berita'] = $this->input->post('berita', TRUE);
			$data['foto'] = $this->upload->data('file_name');
			$data['created_at'] = time();

			$this->admin_model->tambah_berita($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
  		Berita Berhasil <strong> DiTambahkan!.</strong>
   			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
     			<span aria-hidden="true">&times;</span>
   			</button>
		 	</div>');
		 	redirect('admin/berita');
		}	
  }








}