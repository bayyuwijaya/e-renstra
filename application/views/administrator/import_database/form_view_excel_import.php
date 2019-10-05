
<!doctype>
<html>
<head>

</head>
<body>
<style type="text/css">
table{width: 100%}
tr td{padding: 10px; border:1px solid silver;}
</style>


<a href="<?php echo site_url()?>/administrator/import" style="left:10px; padding:10px 20px; position:absolute; ">Back</a>

<?php

header("Content-type: text/html; charset=utf-8");

		
		$i=2;
		echo "<br><br>";
		echo "<table>";
		extract($_POST);

		$arr = array();
		$arr2 = array();
		
		for ($row = $i; $row <= $lastRow; $row++) 
		{
		 	

			$data['id_sdm'] = $this->db->query("select UUID() as id")->row()->id;
			 
			$data['nm_sdm'] = $worksheet->getCell('A'.$row)->getValue();
			$data['tmpt_lahir'] = $worksheet->getCell('B'.$row)->getValue();
			$data['tgl_lahir'] = $worksheet->getCell('C'.$row)->getFormattedValue();
			$data['jk'] = $worksheet->getCell('D'.$row)->getValue();
			$data['nik'] = $worksheet->getCell('E'.$row)->getValue();
			$data['nrp'] = $worksheet->getCell('F'.$row)->getValue();
			$data['npwp'] = $worksheet->getCell('G'.$row)->getValue();
			$data['bpjs'] = $worksheet->getCell('H'.$row)->getValue();
			$data['jln'] = $worksheet->getCell('I'.$row)->getValue();
			$data['kode_pos'] = $worksheet->getCell('J'.$row)->getValue();
			$data['email'] = $worksheet->getCell('K'.$row)->getValue();
			$data['no_tlp'] = $worksheet->getCell('L'.$row)->getValue();
			$data['no_hp'] = $worksheet->getCell('M'.$row)->getValue();
			
			$this->db->select('*');
			$this->db->from('sispeg_tr_pegawai');
			$this->db->like('nik',$worksheet->getCell('E'.$row)->getValue());
			$aa = $this->db->get();
			if( $aa->num_rows() == 0 ){
				//$data['id_sdm'] = $this->db->query("select UUID() as id")->row()->id; 
				array_push($arr, $data);
				$go = "Insert";
			}else{
				array_push($arr2, $data);
				$go = "Update";
			}

			echo "<tr><td>";
		 	echo "<span style='color:green'>$go ".($row-1)."</span>";
			echo "</td><td>";
			echo $worksheet->getCell('A'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('B'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('C'.$row)->getFormattedValue();
			echo "</td><td>";
			echo $worksheet->getCell('D'.$row)->getFormattedValue();
			echo "</td><td>";
			echo $worksheet->getCell('E'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('F'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('G'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('H'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('I'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('J'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('K'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('L'.$row)->getValue();
			echo "</td><td>";
			echo $worksheet->getCell('M'.$row)->getValue();
			echo "</td></tr>";

		}

		echo "</table>";	


		if (!empty($arr))
			$this->db->insert_batch('sispeg_tr_pegawai', $arr);

		if (!empty($arr2))
			$this->db->update_batch('sispeg_tr_pegawai', $arr2,'nik');

		
		
?>

</body>
</html>