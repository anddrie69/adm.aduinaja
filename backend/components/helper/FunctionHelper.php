<?php
namespace backend\components\helper;

class FunctionHelper{

	function UserLevel($param) {
		switch ($param) {
			case '1':
				return 'Administrator';
			break;
			case '2':
				return 'Moderator';
			break;
			case '3':
				return 'Kepala Daerah';
			break;
			case '4':
				return 'Sesuai Kategori';
			break;
			case '5':
				return 'Sesuai Kecamatan';
			break;
			
		}
	}

	function StatusAduan($param) {
		switch ($param) {
			case '1':
				return 'Diterima';
			break;
			case '2':
				return 'Dilaksanakan';
			break;
			case '3':
				return 'Ditolak';
			break;
			
		}
	}

	function arrsKecamatan(){

		$arrs = array(
				'Babadan','Badegan','Balong','Bungkal','Jambon','Jenangan','Jetis','Kauman','Mlarak','Ngebel','Ngrayun','Ponorogo','Pudak','Pulung','Sambit','Sampung','Sawoo','Siman','Slahung','Sooko','Sukorejo'
			);
		return $arrs;
	}
}

