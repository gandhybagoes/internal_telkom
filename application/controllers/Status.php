<?php
/**
* SUKOLILO MULIA 9
A = 15916
B = 16264
C = 14832
H = 2815
*/
class Status extends CI_Controller
{
	function bacaHtml_a($url)
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
	function bacaHtml_b($url)
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
	function bacaHtml_c($url)
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
	function bacaHtml_d($url)
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
	function bacaHtml_e($url)
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
	function bacaHtml_f($url)
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
	function bacaHtml_g($url)
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
	function bacaHtml_h($url)
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
	
	public function fm_status_a()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=0; $i <= 1000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_a($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}
		
	public function fm_status_b()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=1000; $i <= 2000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_b($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_c()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=2000; $i <= 3000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_c($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_d()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=3000; $i <= 4000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_d($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_e()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=4000; $i <= 5000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_e($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_f()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=5000; $i <= 6000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_f($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_g()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=6000; $i <= 7000; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_g($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	public function fm_status_h()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=7000; $i <= 7500; $i++) { 
			$postalCode = $data['fm_streets'][$i]['PostalCode'];
			if (is_null($postalCode)) {
				$postalCode = "";
			} else {
				$postalCode = str_replace(" ", "+", $postalCode);
			}
			$cityName = $data['fm_streets'][$i]['CityName'];
			if (is_null($cityName)) {
				$cityName = "";
			} else {
				$cityName = str_replace(" ", "+", $cityName);
			}
			$areaName = $data['fm_streets'][$i]['AreaName'];
			if (is_null($areaName)) {
				$areaName = "";
			} else {
				$areaName = str_replace(" ", "+", $areaName);
			}
			$complexName = $data['fm_streets'][$i]['ComplexName'];
			if (is_null($complexName)) {
				$complexName = "";
			} else {
				$complexName = str_replace(" ", "+", $complexName);
			}
			$streetName = $data['fm_streets'][$i]['StreetName'];
			if (is_null($streetName)) {
				$streetName = "";
			} else {
				$streetName = str_replace(" ", "+", $streetName);
			}
			$url = "http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=$postalCode&cityName=$cityName&areaName=$areaName&complexName=$complexName&streetName=$streetName";
			$kodeHTML =  $this->bacaHtml_h($url);
			$js = json_decode($kodeHTML, true);
			$data[$i] = $js['results'];
			
				for ($a=0; $a < count($js['results']); $a++) { 
					$data[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$where[$a] = array(
						'ComplexName' => $js['results'][$a]['ComplexName'],
						'StreetName' => $js['results'][$a]['StreetName'],
						'StNum' => $js['results'][$a]['StNum'],
						'SiteId' => $js['results'][$a]['SiteId'],
						'Status' => $js['results'][$a]['Status'],
						'PostalCode' => $js['results'][$a]['PostalCode'],
						'AreaName' => $js['results'][$a]['AreaName'],
						'CityName' => $js['results'][$a]['CityName']
						);
					$cek = $this->model_data->select('fm_status',$where[$a]);
					if (count($cek) > 0) {
						echo "data ada<br>";
					} elseif (count($cek) < 1) {
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
					} else {
						echo "INI ELSE";
					}
						
				}
			}
			
	}

	
}
?>