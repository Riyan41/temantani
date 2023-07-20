<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Galeri_model;
use App\Models\Sewa_model;
use App\Models\User_model;

class Home extends BaseController {

	// Homepage
	public function index() {
		$m_user 		= new User_model();
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_galeri		= new Galeri_model();
		$m_sewa			= new Sewa_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$slider 		= $m_galeri->slider();
		$sewa2 			= $m_sewa->beranda();
		
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
            	'username' 	=> 'required|min_length[3]|is_unique[users.username]',
        	])) {
			// masuk database
			$data = [	'nama'			=> $this->request->getPost('nama'),
						'email'			=> $this->request->getPost('email'),
						'username'		=> $this->request->getPost('username'),
						'nohp'			=> $this->request->getPost('nohp'),
						'alamat_user'	=> $this->request->getPost('alamat'),
						'password'		=> sha1($this->request->getPost('password')),
						'akses_level'	=> "User",
						'tanggal_post'	=> date('Y-m-d H:i:s')
					];
			$m_user->save($data);
			// masuk database
			$this->session->setFlashdata('suksesdaftar','Data telah ditambah');
			return redirect()->to(base_url('home'));
	    }else{
			$data = [	'title'			=> $konfigurasi['namaweb'].' | '.$konfigurasi['tagline'],
						'description'	=> $konfigurasi['namaweb'].', '.$konfigurasi['tentang'],
						'slider'		=> $slider,
						'konfigurasi'	=> $konfigurasi,
						'sewa2'			=> $sewa2,
						'content'		=> 'home/index'
					];
			echo view('layout/wrapper',$data);
		}
	}
}