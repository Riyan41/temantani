<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Konfigurasi_model;
use App\Models\Sewa_model;
use App\Models\Kategori_model;

class Sewa extends BaseController
{

	// index
	public function index()
	{
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_sewa			= new Sewa_model();
		$konfigurasi 	= $m_konfigurasi->listing();
		$sewa 			= $m_sewa->home();
		
		$data = [	'title'			=> 'Sewa '.$konfigurasi['namaweb'],
					'description'	=> 'Sewa '.$konfigurasi['namaweb'],
					'keywords'		=> 'Sewa '.$konfigurasi['namaweb'],
					'sewa'			=> $sewa,
					'content'		=> 'sewa/index'
				];
		echo view('layout/wrapper',$data);
	}

	// read
	public function pesan($slug_sewa)
	{
		$m_sewa		= new Sewa_model();
		$sewa 		= $m_sewa->pesan($slug_sewa);
		
		$data = [	'title'			=> $sewa['nama_alat'],
					'description'	=> $sewa['ringkasan'],
					'sewa'		=> $sewa,
					'content'		=> 'sewa/pesan'
				];
		echo view('layout/wrapper',$data);
	}

	// public function order($id_sewa, $tgl_sewa)
	// {
	// 	$m_sewa		= new Sewa_model();
	// 	$sewa 		= $m_sewa->pesan($id_sewa, $tgl_sewa);
		
	// 	$data = [	'title'			=> $sewa['nama_alat'],
	// 				'description'	=> $sewa['ringkasan'],
	// 				'sewa'		=> $sewa,
	// 				'content'		=> 'sewa/pesan'
	// 			];
	// 	echo view('layout/wrapper',$data);
	// }

	public function order()
	{
		$m_sewa		= new Sewa_model();
				
		if($this->request->getMethod() === 'post') {
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
					'id_sewa2'		=> $this->request->getVar('id_sewa'),
					'id_user'		=> $this->session->get('id_user'),
					'banyak_sewa'	=> $this->request->getVar('harga'),
					'jenis_sewa'	=> $this->request->getVar('jenis_sewa'),
					'jenisharga_sewa'	=> $this->request->getVar('jns_harga'),
					'total_harga'	=> $this->request->getVar('total_sewa2'),
					'tgl_sewa'		=> $this->request->getVar('tanggal'),
					'jenis_bayar'	=> $this->request->getVar('jenis_bayar'),
					'total_bayar'	=> $this->request->getVar('total_bayar'),
					'sisa_bayar'	=> $this->request->getVar('sisa_bayar2'),
					'status_order'	=> "Menunggu Konfirmasi",
					'bukti_foto'	=> $namabaru
				);
				$m_sewa->tambahorder($data);
				return redirect()->to(base_url('history/'))->with('sukses', 'Data Berhasil di Simpan');
			}
		}
	}

	public function check_availability()
	{
		$tanggal = $this->request->getVar('tanggal');
		$idsewa = $this->request->getVar('idsewa');
		$m_sewa = new Sewa_model();
		$sewa = $m_sewa->cektgl($idsewa, $tanggal);
		$response = [
			'available' => ($sewa !== null)
		];

		return $this->response->setJSON($response);
	}

	// informasi
	public function informasi($slug_sewa)
	{
		$m_sewa		= new Sewa_model();
		$sewa 		= $m_sewa->read($slug_sewa);
		
		$data = [	'title'			=> $sewa['judul_sewa'],
					'description'	=> $sewa['judul_sewa'],
					'keywords'		=> $sewa['judul_sewa'],
					'sewa'		=> $sewa,
					'content'		=> 'sewa/informasi'
				];
		echo view('layout/wrapper',$data);
	}

	// kategori
	public function kategori($slug_kategori)
	{
		$m_sewa			= new Sewa_model();
		$m_kategori		= new Kategori_model();
		$kategori 		= $m_kategori->read($slug_kategori);
		$sewa 			= $m_sewa->kategori($kategori['id_kategori']);
		
		$data = [	'title'			=> $kategori['nama_kategori'],
					'description'	=> $kategori['nama_kategori'],
					'keywords'		=> $kategori['nama_kategori'],
					'kategori'		=> $kategori,
					'sewa'		=> $sewa,
					'content'		=> 'sewa/index'
				];
		echo view('layout/wrapper',$data);
	}
}