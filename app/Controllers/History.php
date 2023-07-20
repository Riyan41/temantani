<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Sewa_model;

class History extends BaseController
{
	public function index()
	{
		checklogin();
		$m_history 		= new Sewa_model();
		$history		= "";
		if ($this->session->get('id_user') != null) {
			$history  = $m_history->listhistory($this->session->get('id_user'));
		}

		$data = [	'title'			=> 'Riwayat',
					'description'	=> 'Riwayat',
					'history'		=> $history,
					'content'		=> 'history'
				];
		echo view('layout/wrapper',$data);
	}
}