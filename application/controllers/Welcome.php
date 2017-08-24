<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		date_default_timezone_set("Asia/Jakarta"); 
		echo date("h:i:sa"); 
	}

	function bacaHtml($url)
	{
		// inisialisasi CURL
	     $data = curl_init();
	     // setting CURL
	     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
	     curl_setopt($data, CURLOPT_URL, $url);
	     // menjalankan CURL untuk membaca isi file
	     $hasil = curl_exec($data);
	     curl_close($data);
	     return $hasil;
	}

	public function grab_fm_building($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['area']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$buildings = $js['buildings']; //data asli dari web (buildings)
			
				for($i=0;$i<count($buildings);$i++){
					$where[$i] = array(
						'BuildingName' => $buildings[$i]['BuildingName'],
						'AreaName' => $buildings[$i]['AreaName'],
						'CityName' => $buildings[$i]['CityName'],
						'PostalCode' => $buildings[$i]['PostalCode'],
						'sorter' => $buildings[$i]['sorter'],
						'type' => 'building'
						);
					$cek = $this->model_data->select('fm_buildings',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_buildings',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_buildings'));
						echo "data tidak sama dan sekarang sudah sama -> data BUILDING Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

	public function grab_fm_street($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['area']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$streets = $js['streets']; //data asli dari web (streets)
			
				for($i=0;$i<count($streets);$i++){
					$where[$i] = array(
						'StreetName' => $streets[$i]['StreetName'],
						'ComplexName' => $streets[$i]['ComplexName'],
						'AreaName' => $streets[$i]['AreaName'],
						'CityName' => $streets[$i]['CityName'],
						'PostalCode' => $streets[$i]['PostalCode'],
						'sorter' => $streets[$i]['sorter'],
						'type' => 'street'
						);
					$cek = $this->model_data->select('fm_streets',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_streets',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_streets'));
						echo "data tidak sama dan sekarang sudah sama -> data STREETS Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

	public function grab_fm_complex($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 70;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['area']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$complexes = $js['complexes']; //data asli dari web (buildings)
			
				for($i=0;$i<count($complexes);$i++){
					$where[$i] = array(
						'ComplexName' => $complexes[$i]['ComplexName'],
						'AreaName' => $complexes[$i]['AreaName'],
						'CityName' => $complexes[$i]['CityName'],
						'PostalCode' => $complexes[$i]['PostalCode'],
						'sorter' => $complexes[$i]['sorter'],
						'type' => 'complex'
						);
					$cek = $this->model_data->select('fm_complexes',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_complexes',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_complexes'));
						echo "data tidak sama dan sekarang sudah sama -> data COMPLEX Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

	public function grab_fm_building_lokasi($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['lokasi']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$buildings = $js['buildings']; //data asli dari web (buildings)
			
				for($i=0;$i<count($buildings);$i++){
					$where[$i] = array(
						'BuildingName' => $buildings[$i]['BuildingName'],
						'AreaName' => $buildings[$i]['AreaName'],
						'CityName' => $buildings[$i]['CityName'],
						'PostalCode' => $buildings[$i]['PostalCode'],
						'sorter' => $buildings[$i]['sorter'],
						'type' => 'building'
						);
					$cek = $this->model_data->select('fm_buildings',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_buildings',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_buildings'));
						echo "data tidak sama dan sekarang sudah sama -> data BUILDING Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

	public function grab_fm_streett($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['lokasi']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$streets = $js['streets']; //data asli dari web (streets)
			
				for($i=0;$i<count($streets);$i++){
					$where[$i] = array(
						'StreetName' => $streets[$i]['StreetName'],
						'ComplexName' => $streets[$i]['ComplexName'],
						'AreaName' => $streets[$i]['AreaName'],
						'CityName' => $streets[$i]['CityName'],
						'PostalCode' => $streets[$i]['PostalCode'],
						'sorter' => $streets[$i]['sorter'],
						'type' => 'street'
						);
					$cek = $this->model_data->select('fm_streets',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_streets',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_streets'));
						echo "data tidak sama dan sekarang sudah sama -> data STREETS Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

	public function grab_fm_complexx($table)
	{
		date_default_timezone_set("Asia/Jakarta");
		if ($table == "area") {
			$area = $this->model_data->select_fm('data_area_fm');
		} else {
			$area = $this->model_data->select_fm('data_lokasi_fm');
		}
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['lokasi']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			
			$js = json_decode($kodeHTML, true);
			$complexes = $js['complexes']; //data asli dari web (buildings)
			
				for($i=0;$i<count($complexes);$i++){
					$where[$i] = array(
						'ComplexName' => $complexes[$i]['ComplexName'],
						'AreaName' => $complexes[$i]['AreaName'],
						'CityName' => $complexes[$i]['CityName'],
						'PostalCode' => $complexes[$i]['PostalCode'],
						'sorter' => $complexes[$i]['sorter'],
						'type' => 'complex'
						);
					$cek = $this->model_data->select('fm_complexes',$where[$i]);
					if(count($cek) > 0)
					{
						echo "data sama (".date("h:i:sa").")";
						echo "<br>";
						var_dump($cek);
						echo "<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_complexes',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_complexes'));
						echo "data tidak sama dan sekarang sudah sama -> data COMPLEX Ke - $dataKe - (".date("h:i:sa").")";
						echo "<br>";
					} elseif ($cek == "" || $cek == null) {
						echo "INI ELSE ($keyword)";
						echo "<br>";
					} else {
						echo "string";
						echo "<br>";
					}
				}
		} 
		echo "DONE($keyword) <br><br><br>";
		$startarea += 1;
		} while ($startarea <= $z);
	}

}
