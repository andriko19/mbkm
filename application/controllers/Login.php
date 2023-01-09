<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->model('auth_model');
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
			<link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/sweetalert2/animate.min.css">
			<script src="<?= base_url(); ?>assets/frontend/sweetalert2/sweetalert2.min.js"></script>
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
					'username'=> $user['username'],
					'nama' 		=> $user['nama'],
					'role' 		=> $user['role']
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
				} else if ($user['role'] == 'mahasiswa'){
					?>
						<!-- jika rolenya selain administrator -->
						<script type="text/javascript">
							Swal.fire({
				        icon: 'success',
				        title: 'Success',
				        text: 'Selamat, Anda Berhasil Login Sebagai Mahasiswa!'
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
			      	window.location='<?=site_url('login')?>';
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
		      	window.location='<?=site_url('login')?>';
		      }) 
				</script>
			<?php
		}
	}

	public function logout() 
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role');

		?>
			<link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/sweetalert2/animate.min.css">
			<script src="<?= base_url(); ?>assets/frontend/sweetalert2/sweetalert2.min.js"></script>
			<style type="text/css">
				body {
					font-family: "Helvetice Neve", Helvetice, Arial, sans-serif;
					font-size : 1.124em;
					font-weight: normal;
				}
			</style>
			<body></body>

			<script type="text/javascript">
				Swal.fire({
					icon: 'success',
					title: 'Success',
					text: 'Anda Berhasil Logout!'
				}).then((result) => {
					window.location='<?=site_url('login')?>';
				}) 
			</script>
		<?php
	}

	public function auth_register()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'Tidak Boleh Kosong!',
			'valid_email' => 'Format Email Salah!'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
			'is_unique' => 'Username sudah digunakan!',
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password_confirm]',[
			'matches' => 'Password harus sama!',
			'min_length' => 'Password harus 6 karakter!',
			'required' => 'Tidak Boleh Kosong!'
		]);
		$this->form_validation->set_rules('password_confirm', 'Password', 'required|trim|matches[password]');

		if($this->form_validation->run()==false) {
			$data['title'] = 'Register';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('templates/auth_register');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'username' 		=> htmlspecialchars($this->input->post('username', 'true')),
				'nama'   			=> htmlspecialchars($this->input->post('nama', 'true')),
				'email'				=> htmlspecialchars($this->input->post('email', 'true')),
				'password'  	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' 				=> "mahasiswa",
				'created_at'  => date('Y-m-d')
			];
			$this->auth_model->add_users($data);
			$this->session->set_flashdata('message', '<span type="" class="alert btn btn-block btn-success btn-lg font-weight-medium auth-form-btn mb-3">Akun Baru Berhasil <strong> DiTambahkan!.</strong></span>');
			redirect('login');
		}
	}


}
