<?php
/**
* 
*/
class Model_data extends CI_Model
{

	public function insert($table,$data)
	{
		$this->db->insert($table, $data);
	}

	public function select($table,$where)
	{
		$query = $this->db->select('*')
						  ->from($table)
						  ->where($where)
						  ->get();
		return $query->result_array();
	}
	
	function insert_fm($data)
	{
		$js = json_decode($data, true);
		$data = $js['buildings'];
		$jumlah = count($data);
		/*echo $data[0]['BuildingName'];
		die();*/
		for($i = 0; $i < $jumlah; $i++) {
			$this->db->query("INSERT INTO fm_buildings(BuildingName,AreaName,CityName,PostalCode,sorter,type) VALUES('".$data[$i]['BuildingName']."', '".$data[$i]['AreaName']."', '".$data[$i]['CityName']."', '".$data[$i]['PostalCode']."', '".$data[$i]['sorter']."', 'building')");
		}

		var_dump($data);
	}

	public function select_fm($table)
	{
		$query = $this->db->select('*')
						  ->from($table)
						  ->get();
		return $query->result_array();
	}

	public function select_bz($table,$where)
	{
		$query = $this->db->select('*')
						  ->from($table)
						  ->like($where)
						  ->get();
		return $query->result_array();
	}

	public function select_fm_tertentu($table,$where)
	{
		$query = $this->db->select('*')
						  ->from($table)
						  ->where($where)
						  ->get();
		return $query->num_rows();
	}

	function updatedata($where,$data,$table){
        $this->db->where($where);
        $this->db->set($data);
        $this->db->update($table);
    }
}
?>