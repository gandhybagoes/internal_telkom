<?php
/**
* 
*/
class Grab extends CI_Controller
{
	
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

	public function fm($cluster){
		/*'http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=60124&cityName=SURABAYA&areaName=BULAK&complexName=PAITON&streetName=SURABAYA-SITUBONDO+RAYA%2FKM'

		'http://www.firstmedia.com/ajax/coverage/new?source=streetname&postalCode=65115&cityName=KOTAMADYA+MALANG&areaName=KLOJEN&complexName=&streetName=SURABAYA'*/
		//error_reporting(0);
		$area = $this->model_data->select_fm('data_area_fm');
		$y = 1;
		$z = 127;
		$startarea = $y;
		do{
			for($x=0; $x<$startarea; $x++){
			$keyword = str_replace(" ", "+", $area[$x]['area']);
			$url = "http://www.firstmedia.com/ajax/address?keyword=$keyword";
			$kodeHTML =  $this->bacaHtml("$url");
			/*echo $kodeHTML;
			die();*/
			$js = json_decode($kodeHTML, true);
			$status = $js['status'];
			$buildings = $js['buildings'];
			$streets = $js['streets'];
			$complexes = $js['complexes'];

			$data['fm_buildings'] = $this->model_data->select_fm('fm_buildings');
			$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
			$data['fm_complexes'] = $this->model_data->select_fm('fm_complexes');
			$data['fm_status'] = $this->model_data->select_fm('fm_status');
			
			$jumlah = count($data['fm_streets']);
			
			//BUILDING
				for($i=0;$i<count($buildings);$i++){
					$where[$i] = array(
						'BuildingName' => $buildings[$i]['BuildingName'],
						'AreaName' => $buildings[$i]['AreaName'],
						'CityName' => $buildings[$i]['CityName'],
						'PostalCode' => $buildings[$i]['PostalCode'],
						'sorter' => $buildings[$i]['sorter'],
						'type' => 'building'
						);
					$cek = $this->model_data->select_fm_tertentu('fm_buildings',$where[$i]);
					if($cek > 0)
					{
						echo "data sama";
						echo "<br>";
					} 
					else 
					{
						$this->model_data->insert('fm_buildings',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_buildings'));
						echo "data tidak sama dan sekarang sudah sama -> data BUILDING Ke - $dataKe";
						echo "<br>";
					}
				}
			//END BUILDING

			//STREETS
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
					$cek = $this->model_data->select_fm_tertentu('fm_streets',$where[$i]);
					if($cek > 0)
					{
						echo "data sama";
						echo "<br>";
					} 
					else 
					{
						$this->model_data->insert('fm_streets',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_streets'));
						echo "data tidak sama dan sekarang sudah sama -> data STREETS Ke - $dataKe";
						echo "<br>";
					}
				}
			//END STREETS

			//COMPLEX
				for($i=0;$i<count($complexes);$i++){
					$where[$i] = array(
						'ComplexName' => $complexes[$i]['ComplexName'],
						'AreaName' => $complexes[$i]['AreaName'],
						'CityName' => $complexes[$i]['CityName'],
						'PostalCode' => $complexes[$i]['PostalCode'],
						'sorter' => $complexes[$i]['sorter'],
						'type' => 'complex'
						);
					$cek = $this->model_data->select_fm_tertentu('fm_complexes',$where[$i]);
					if($cek > 0)
					{
						echo "data sama";
						echo "<br>";
					} 
					else 
					{
						$this->model_data->insert('fm_complexes',$where[$i]);
						$dataKe = count($this->model_data->select_fm('fm_complexes'));
						echo "data tidak sama dan sekarang sudah sama -> data COMPLEX Ke - $dataKe";
						echo "<br>";
					}
				}
			//END COMPLEX
			} 
			$startarea += 1;
				echo "DONE <br><br><br>";
		} while ($startarea <= $z);
	}

	public function fm_status()
	{
		date_default_timezone_set("Asia/Jakarta");
		//error_reporting(0);

		$data['fm_streets'] = $this->model_data->select_fm('fm_streets');
		
		$jumlah = count($data['fm_streets']);//2593
		//0-200 201-400 401-600 601-800 801-1000 1001-1200 1201-1400 1401-1600 1601-1800 1801-2000 2001-2200 2201-2400 2401-2593
		for ($i=0; $i <= $jumlah; $i++) { 
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
			$kodeHTML =  $this->bacaHtml($url);
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
					/*var_dump($data[$a]);
					echo "<br><br>";*/
						$this->model_data->insert('fm_status',$data[$a]);
						$data['fm_status'] = $this->model_data->select_fm('fm_status');
						echo "data tidak sama dan sekarang sudah sama -> ".count($data['fm_status'])." (".date("h:i:sa").")";
						echo "<br>";
				}
			
		}
		
	}

	public function bz($id)
	{
		error_reporting(0);
		$kodeHTML =  $this->bacaHtml("http://www.biznetnetworks.com/id/coverage-area/?arealist=$id&txtSearch=");
		$cityName = "";
		if ($id == 52) {
			$cityName = "BANYUWANGI";
			echo $cityName."<br>";
		} elseif ($id == 107) {
			$cityName = "BOJONEGORO";
			echo $cityName."<br>";
		} elseif ($id == 7) {
			$cityName = "DENPASAR";
			echo $cityName."<br>";
		} elseif ($id == 20) {
			$cityName = "GIANYAR";
			echo $cityName."<br>";
		} elseif ($id == 57) {
			$cityName = "JEMBER";
			echo $cityName."<br>";
		} elseif ($id == 58) {
			$cityName = "KEDIRI";
			echo $cityName."<br>";
		} elseif ($id == 61) {
			$cityName = "LUMAJANG";
			echo $cityName."<br>";
		} elseif ($id == 56) {
			$cityName = "MADIUN";
			echo $cityName."<br>";
		} elseif ($id == 17) {
			$cityName = "MALANG";
			echo $cityName."<br>";
		} elseif ($id == 89) {
			$cityName = "MOJOKERTO";
			echo $cityName."<br>";
		} elseif ($id == 65) {
			$cityName = "MUNCAR";
			echo $cityName."<br>";
		} elseif ($id == 59) {
			$cityName = "NEGARA";
			echo $cityName."<br>";
		} elseif ($id == 50) {
			$cityName = "PASURUAN";
			echo $cityName."<br>";
		} elseif ($id == 83) {
			$cityName = "PROBOLINGGO";
			echo $cityName."<br>";
		} elseif ($id == 47) {
			$cityName = "SIDOARJO";
			echo $cityName."<br>";
		} elseif ($id == 6) {
			$cityName = "SURABAYA";
			echo $cityName."<br>";
		} elseif ($id == 51) {
			$cityName = "TABANAN";
			echo $cityName."<br>";
		} else {
			echo "KOTA TIDAK ADA";
			echo $cityName."<br>";
		}
		
		$pecah = explode('<div class="col-lg-12">', $kodeHTML);
		$pecah2 = explode('<div class="footer-v1">', $pecah[2]);
		$pecah3 = explode('</h2></div>', $pecah2[0]);
		$data = $pecah3[1];
		$data = strip_tags($data);
		$data = str_replace("\t", "", $data);
		$data = str_replace("\r", "", $data);
		$data = str_replace("\n", "", $data);
		$data = str_replace("&nbsp", "", $data);
		$data = str_replace("LAYANAN BISNISLAYANAN PERUMAHAN", "", $data);
		$data = str_replace("KODEPOS", ", KODEPOS", $data);
		$data = str_replace("NetworkInternet", ", NetworkInternet", $data);
		$data = explode(";", $data);
		for($i=1;$i<count($data);$i++){
			$dataFix = explode(",", $data[$i]);
			//var_dump($dataFix);
			$dataArray = array(
				'kota'      => $cityName,
				'jalan'     => $dataFix[0],
				'kecamatan' => $dataFix[1],
				'kelurahan' => $dataFix[2],
				'kodepos'   => $dataFix[3],
				);
			$cek = $this->model_data->select_bz('bz_data',$dataArray);
			if ($cek == null || $cek == "") {
				echo "data tidak ada<br>";
				$this->model_data->insert('bz_data',$dataArray);
				echo "data berhasil di tambahkan";
			} else {
				echo "data ada<br>";
				var_dump($dataArray);
			}
			//var_dump($dataArray);
			echo "<br><br>";
		}
		die();
		$js = json_decode($kodeHTML, true);
	}

	public function myrep($city)
	{
		if ($city == "malang" || $city == "Malang") {
			$city = "Malang";
		} else {
			$city = "Surabaya";
		}
		$kodeHTML =  $this->bacaHtml("https://order.myrepublic.co.id/api/v1/HPCluster/?state=Jawa+Timur&city=$city");
		$data = str_replace("[", "", $kodeHTML);
		$data = str_replace("]", "", $data);
		$data = explode("},", $data);
		$jumlah_data = count($data);
		
		for ($i=0; $i < $jumlah_data; $i++) { 
			$data1 = str_replace("{", "", $data[$i]);
			$data2 = str_replace("}", "", $data1);
			$data3 = str_replace(":", "", $data2);
			$data4 = str_replace("state", "", $data3);
			$data5 = str_replace("city", "", $data4);
			$data6 = str_replace("cluster", "", $data5);
			$data7 = str_replace('"', '', $data6);

			$dataFix = explode(",", $data7);

			$dataArray = array(
				'state'      => $dataFix[0],
				'city'     => $dataFix[1],
				'cluster' => $dataFix[2],
				);
			if ($dataFix[1] == "Malang" || $dataFix[1] == "malang") {
				$this->model_data->insert('myrep_malang',$dataArray);
			} else {
				$this->model_data->insert('myrep_surabaya',$dataArray);
			}
			
			var_dump($data7);
			echo "<br>"; 
		}
	}

	public function myrep_sub($table)
	{
		//& = %26
		//spasi = +
		//error_reporting(0);
		$table2 = "";
		if ($table == "malang" || $table == "Malang" || $table == "MALANG") {
			$table = "myrep_malang";
			$table2 = "myrep_sub_malang";
		} else {
			$table = "myrep_surabaya";
			$table2 = "myrep_sub_surabaya";
		}
		$database = $this->model_data->select_fm($table);
		//0-20 20-40 40-60 60-80 80-100 100-120 120-140 140-160 160-180 180-200 200-220 220-240 240-260 260-268
		for ($i=260; $i < 268; $i++) { 
			$state = $database[$i]['state'];
			$city = $database[$i]['city'];
			$clusterAsli = $database[$i]['cluster'];
			$cluster = str_replace(" ", "+", $database[$i]['cluster']);
			$cluster = str_replace("&", "%26", $cluster);
			
			//echo $state."-".$city."-".$cluster."<br>";

			$kodeHTML =  $this->bacaHtml("https://order.myrepublic.co.id/api/v1/HPDetail/?state=Jawa+Timur&city=$city&commercial_name=$cluster&address=$cluster");
			
			$data = explode(":[", $kodeHTML);
			$data1 = str_replace("homepassdetailid", "", $data[1]);
			$data2 = str_replace("address", "", $data1);
			$data3 = str_replace(":", "", $data2);
			$data4 = str_replace('"', '', $data3);
			$data5 = str_replace("{", "", $data4);
			$data6 = str_replace("}]}", "", $data5);
			$data7 = explode("},", $data6);

			$jumlah_data = count($data7);
			
			for ($a=0; $a < $jumlah_data; $a++) { 
				$dataFix = explode(",", $data7[$a]);
				$dataArray = array(
					'homepassdetailid' => $dataFix[0],
					'address' => $dataFix[1],
					'cluster' => $clusterAsli,
					);
				$this->model_data->insert($table2,$dataArray);
				var_dump($dataArray);
				echo "<br><br>";
			}
		}
		//$kodeHTML =  $this->bacaHtml("https://order.myrepublic.co.id/api/v1/HPDetail/?state=Jawa+Timur&city=Malang&commercial_name=BAIDURI+AREA&address=aaaa");

	}

}
?>