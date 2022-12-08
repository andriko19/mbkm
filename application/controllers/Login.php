<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
		// $this->load->model('users_model');
	}

	public function index()
	{
		// if ($this->session->userdata('username')) {
		// 	redirect('templates/admin_login');
		// }

		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'Tidak Boleh Kosong!'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('templates/auth_login');
			$this->load->view('templates/auth_footer');
		} else {
			// apabila validasi alert-success
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		?>
			<link rel="stylesheet" href="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?= base_url(); ?>assets/sweetalert2/animate.min.css">
			<script src="<?= base_url(); ?>assets/Sweetalert2/Sweetalert2.min.js"></script>
			<style type="text/css">
				body {
					font-family: "Helvetice Neve", Helvetice, Arial, sans-serif;
					font-size : 1.124em;
					font-weight: normal;
				}
			</style>
			<body></body>
		<?php
		// jika usernya ada
		if ($user) {
			// jika passwornya benar
			if (password_verify($password, $user['password'])) {
				// jika benar
				$data = [
					'username' 	 		=> $user['username'],
					'nama_depan' 		=> $user['nama_depan'],
					'nama_belakang' => $user['nama_belakang'],
					'role' 					=> $user['role']
				];
				$this->session->set_userdata($data);
				if ($user['role'] == 'administrator') {
					?>
						<script type="text/javascript">
							Swal.fire({
				        icon: 'success',
				        title: 'Success',
				        text: 'Selamat Admin, Anda Berhasil Login!'
				      }).then((result) => {
				      	window.location='<?=site_url('admin')?>';
				      }) 
						</script>
					<?php
				} else {
					?>
						<script type="text/javascript">
							Swal.fire({
				        icon: 'success',
				        title: 'Success',
				        text: 'Selamat Admin BEM atau UKM, Anda Berhasil Login!'
				      }).then((result) => {
				      	window.location='<?=site_url('admin/dashboard_informasi')?>';
				      }) 
						</script>
					<?php
				}
			} else {
				?>
					<script type="text/javascript">
						Swal.fire({
			        icon: 'error',
			        title: 'Peringatan',
			        text: 'Password Anda Salah!'
			      }).then((result) => {
			      	window.location='<?=site_url('home')?>';
			      }) 
					</script>
				<?php
			}
		} else {
			?>
				<script type="text/javascript">
					Swal.fire({
		        icon: 'error',
		        title: 'Peringatan',
		        text: 'Username Belum Terdaftar!'
		      }).then((result) => {
		      	window.location='<?=site_url('home')?>';
		      }) 
				</script>
			<?php
		}
	}

	public function logout() 
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama_depan');
		$this->session->unset_userdata('nama_belakang');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', 'Anda Sudah Berhasil Logout.');
		redirect('home');
	}

	public function auth_register()
	{
		// $user = $this->session->userdata('username');
		// $data['user'] 	= $this->admin_model->user($user);
		// $data['akun_ormawa'] = $this->admin_model->getAkunOrmawa();
		// $data['title'] 	= 'Akun Ormawa';
		
		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'required|trim', [
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required|trim', [
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'is_unique' => 'Username sudah digunakan!',
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',[
			'matches' => 'Password harus sama!',
			'min_length' => 'Password harus 6 karakter!',
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if($this->form_validation->run()==false) {
			$data['title'] = 'Register';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('templates/auth_register');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'nama_depan'   => htmlspecialchars($this->input->post('nama_depan', 'true')),
				'nama_belakang'=> htmlspecialchars($this->input->post('nama_belakang', 'true')),
				'username'     => htmlspecialchars($this->input->post('username', 'true')),
				'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role' 			=> htmlspecialchars($this->input->post('role', 'true')),
				'foto' 		   	 => 'default.jpg',
				'created_at'   => date('Y-m-d')
			];
			$this->admin_model->tambah_ormawa_baru($data);
			$this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
			Akun Baru Berhasil <strong> DiTambahkan!.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>');
			redirect('admin/akun_ormawa');
		}
	}


}
