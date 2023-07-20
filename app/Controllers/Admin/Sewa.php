<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Sewa_model;
use App\Models\Kategori_model;
use App\Models\User_model;

class Sewa extends BaseController
{
	
	// index
	public function index()
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$sewa 			= $m_sewa->listing();
		$total 			= $m_sewa->total();

		$data = [	'title'			=> 'Informasi ('.$total.')',
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	
	public function sewaalat()
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$sewa			= "";
		$total			= "";
		if ($this->session->get('akses_level') == "User") {
			$sewa  = $m_sewa->listingalat($this->session->get('id_user'));
			$total = $m_sewa->totalalat($this->session->get('id_user'));
		} else {
			$sewa = $m_sewa->listingalat2();
			$total = $m_sewa->totalalat2();
		}

		$data = [	'title'			=> 'Sewa Alat ('.$total.')',
					'sewa'			=> $sewa,
					'content'		=> 'admin/sewa/indexalat'
				];
		echo view('admin/layout/wrapper',$data);
	}

	public function riwayatsewa()
	{
		checklogin();
		$m_history 		= new Sewa_model();
		$history			= "";
		$total			= "";
		if ($this->session->get('akses_level') == "User") {
			$history  = $m_history->listhistory($this->session->get('id_user'));
			$total = $m_history->totalhistory($this->session->get('id_user'));
		} else {
			$history  = $m_history->listhistory2();
			$total = $m_history->totalhistory2();
		}

		$data = [	'title'			=> 'Riwayat Sewa Alat ('.$total.')',
					'history'		=> $history,
					'content'		=> 'admin/sewa/riwayatsewa'
				];
		echo view('admin/layout/wrapper',$data);
	}

	public function konfirm($id_order)
	{
		$m_history 		= new Sewa_model();
		$data = array(
			'id_order'		=> $id_order,
			'status_order'	=> "Konfirmasi"
		);
		$m_history->konfirmHist($data);
		return redirect()->to(base_url('admin/sewa/riwayatsewa/'))->with('sukses', 'Data Berhasil di Simpan');
	}

	public function lunas($id_order, $tot_harga)
	{
		$m_history 		= new Sewa_model();
		$data = array(
			'id_order'		=> $id_order,
			'jenis_bayar'	=> "lunas",
			'total_bayar'	=> $tot_harga,
			'sisa_bayar'	=> 0
		);
		$m_history->konfirmHist($data);
		return redirect()->to(base_url('admin/sewa/riwayatsewa/'))->with('sukses', 'Data Berhasil di Simpan');
	}

	// kategori
	public function kategori($id_kategori)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$m_kategori 	= new Kategori_model();
		$kategori 		= $m_kategori->detail($id_kategori);
		$sewa 			= $m_sewa->kategori_all($id_kategori);
		$total 			= $m_sewa->total_kategori($id_kategori);

		$data = [	'title'			=> $kategori['nama_kategori'].' ('.$total.')',
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// jenis_sewa
	public function jenis_sewa($jenis_sewa)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$m_kategori 	= new Kategori_model();
		$sewa 		= $m_sewa->jenis_sewa_all($jenis_sewa);
		$total 			= $m_sewa->total_jenis_sewa($jenis_sewa);

		$data = [	'title'			=> $jenis_sewa.' ('.$total.')',
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// status_sewa
	public function status_sewa($status_sewa)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$m_kategori 	= new Kategori_model();
		$kategori 		= $m_kategori->detail($id_kategori);
		$sewa 		= $m_sewa->status_sewa_all($status_sewa);
		$total 			= $m_sewa->total_status_sewa($status_sewa);

		$data = [	'title'			=> $status_sewa.' ('.$total.')',
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// author
	public function author($id_user)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$m_kategori 	= new Kategori_model();
		$m_user 		= new User_model();
		$user 			= $m_user->detail($id_user);
		$sewa 		= $m_sewa->author_all($id_user);
		$total 			= $m_sewa->total_author($id_user);

		$data = [	'title'			=> $user['nama'].' ('.$total.')',
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		checklogin();
		$m_kategori 	= new Kategori_model();
		$m_sewa 		= new Sewa_model();
		$kategori 		= $m_kategori->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_sewa' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user'		=> $this->session->get('id_user'),
					'slug_sewa'	=> strtolower(url_title($this->request->getVar('judul_sewa'))),
					'judul_sewa'	=> $this->request->getVar('judul_sewa'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					// 'jenis_harga'	=> $this->request->getVar('jenis_harga'),
					// 'harga_sewa'	=> $this->request->getVar('harga_sewa'),
					// 'hargasewa_pekerja'		=> $this->request->getVar('hargasewa_pekerja'),
					'isi'			=> $this->request->getVar('isi'),
					'status_sewa'	=> $this->request->getVar('status_sewa'),
					'icon'			=> $this->request->getVar('icon'),
					'gambar' 		=> $namabaru,
					'tanggal_post'	=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_sewa->tambah($data);
	        	return redirect()->to(base_url('admin/sewa/'.$this->request->getVar('jenis_sewa')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user'		=> $this->session->get('id_user'),
					'slug_sewa'	=> strtolower(url_title($this->request->getVar('judul_sewa'))),
					'judul_sewa'	=> $this->request->getVar('judul_sewa'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'isi'			=> $this->request->getVar('isi'),
					'status_sewa'	=> $this->request->getVar('status_sewa'),
					'icon'			=> $this->request->getVar('icon'),
					'tanggal_post'	=> date('Y-m-d H:i:s'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_sewa->tambah($data);
	        	return redirect()->to(base_url('admin/sewa/'.$this->request->getVar('jenis_sewa')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'			=> 'Tambah Post',
					'kategori'		=> $kategori,
					'content'		=> 'admin/sewa/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	public function tambahalat()
	{
		checklogin();
		$m_kategori 	= new Kategori_model();
		$m_sewa 		= new Sewa_model();
		$kategori 		= $m_kategori->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_alat' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_user2'		=> $this->session->get('id_user'),
	        		'kategori_id'	=> $this->request->getVar('id_kategori'),
					'nama_alat'		=> $this->request->getVar('nama_alat'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'jenis_harga'	=> $this->request->getVar('jenis_harga'),
					'harga_sewa'	=> $this->request->getVar('harga_sewa'),
					'hargasewa_pekerja'		=> $this->request->getVar('hargasewa_pekerja'),
					'status_alat'	=> $this->request->getVar('status_alat'),
					'foto' 		=> $namabaru
	        	);
	        	$m_sewa->tambahalat($data);
	        	return redirect()->to(base_url('admin/sewa/sewaalat/'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_user2'		=> $this->session->get('id_user'),
	        		'kategori_id'	=> $this->request->getVar('id_kategori'),
					'nama_alat'		=> $this->request->getVar('nama_alat'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'jenis_harga'	=> $this->request->getVar('jenis_harga'),
					'harga_sewa'	=> $this->request->getVar('harga_sewa'),
					'hargasewa_pekerja'			=> $this->request->getVar('hargasewa_pekerja'),
					'status_alat'	=> $this->request->getVar('status_alat')
	        	);
	        	$m_sewa->tambahalat($data);
	        	return redirect()->to(base_url('admin/sewa/sewaalat/'.$this->request->getVar('jenis_sewa')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'			=> 'Tambah Post',
					'kategori'		=> $kategori,
					'content'		=> 'admin/sewa/tambahalat'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_sewa)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$sewa 			= $m_sewa->detail($id_sewa);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'judul_sewa' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(
	        		'id_sewa'		=> $id_sewa,
	        		'id_user'		=> $this->session->get('id_user'),
					'slug_sewa'	=> strtolower(url_title($this->request->getVar('judul_sewa'))),
					'judul_sewa'	=> $this->request->getVar('judul_sewa'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'isi'			=> $this->request->getVar('isi'),
					'status_sewa'	=> $this->request->getVar('status_sewa'),
					'icon'			=> $this->request->getVar('icon'),
					'gambar' 		=> $namabaru,
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_sewa->edit($data);
       		 	return redirect()->to(base_url('admin/sewa/'.$this->request->getVar('jenis_sewa')))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_sewa'		=> $id_sewa,
	        		'id_user'		=> $this->session->get('id_user'),
					'slug_sewa'	=> strtolower(url_title($this->request->getVar('judul_sewa'))),
					'judul_sewa'	=> $this->request->getVar('judul_sewa'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'isi'			=> $this->request->getVar('isi'),
					'status_sewa'	=> $this->request->getVar('status_sewa'),
					'icon'			=> $this->request->getVar('icon'),
					'tanggal_publish'	=> date('Y-m-d',strtotime($this->request->getVar('tanggal_publish'))).' '.date('H:i',strtotime($this->request->getVar('jam')))
	        	);
	        	$m_sewa->edit($data);
       		 	return redirect()->to(base_url('admin/sewa/'.$this->request->getVar('jenis_sewa')))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'			=> 'Edit: '.$sewa['judul_sewa'],
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	public function editalat($id_sewa)
	{
		checklogin();
		$m_sewa 		= new Sewa_model();
		$m_kategori 	= new Kategori_model();
		$kategori 		= $m_kategori->listing();
		$sewa 			= $m_sewa->detailalat($id_sewa);
		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama_alat' 	=> 'required',
				'gambar'	 	=> [
					                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
					                'max_size[gambar,4096]',
            					],
        	])) {
			if(!empty($_FILES['gambar']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('gambar');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/image/',$namabaru);
	            // Create thumb
	            $image = \Config\Services::image()
			    ->withFile(WRITEPATH . '../assets/upload/image/'.$namabaru)
			    ->fit(100, 100, 'center')
			    ->save(WRITEPATH . '../assets/upload/image/thumbs/'.$namabaru);
	        	// masuk database
	        	$data = array(			
	        		'id_user2'		=> $this->session->get('id_user'),		
	        		'kategori_id'	=> $this->request->getVar('id_kategori'),
					'nama_alat'		=> $this->request->getVar('nama_alat'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'jenis_harga'	=> $this->request->getVar('jenis_harga'),
					'harga_sewa'	=> $this->request->getVar('harga_sewa'),
					'hargasewa_pekerja'		=> $this->request->getVar('hargasewa_pekerja'),
					'status_alat'	=> $this->request->getVar('status_alat'),
					'foto' 			=> $namabaru,
	        		'id_sewa2'		=> $id_sewa
	        	);
	        	$m_sewa->editalat($data);
       		 	return redirect()->to(base_url('admin/sewa/sewaalat/'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{
	        	$data = array(
	        		'id_sewa2'		=> $id_sewa,
	        		'id_user2'		=> $this->session->get('id_user'),
	        		'kategori_id'	=> $this->request->getVar('id_kategori'),
					'nama_alat'		=> $this->request->getVar('nama_alat'),
					'ringkasan'		=> $this->request->getVar('ringkasan'),
					'jenis_harga'	=> $this->request->getVar('jenis_harga'),
					'harga_sewa'	=> $this->request->getVar('harga_sewa'),
					'hargasewa_pekerja'		=> $this->request->getVar('hargasewa_pekerja'),
					'status_alat'	=> $this->request->getVar('status_alat')
	        	);
	        	$m_sewa->editalat($data);
       		 	return redirect()->to(base_url('admin/sewa/sewaalat/'))->with('sukses', 'Data Berhasil di Simpan');
	        }
	    }

		$data = [	'title'		=> 'Edit: '.$sewa['nama_alat'],
					'kategori'	=> $kategori,
					'sewa'		=> $sewa,
					'content'		=> 'admin/sewa/editalat'
				];
		echo view('admin/layout/wrapper',$data);
	}
	
	// Delete
	public function delete($id_sewa)
	{
		checklogin();
		$m_sewa = new Sewa_model();
		$data = ['id_sewa'	=> $id_sewa];
		$m_sewa->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/sewa'));
	}

	public function deletealat($id_sewa)
	{
		checklogin();
		$m_sewa = new Sewa_model();
		$data = ['id_sewa2'	=> $id_sewa];
		$m_sewa->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/sewa/sewaalat'));
	}
}