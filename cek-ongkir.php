<?php
	$kota_asal = $_POST['kota_asal'];
	$kota_tujuan = $_POST['kota_tujuan'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat']*1000;

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: fd230ec47149d44b2a7a46194e44cec2"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	$data= json_decode($response, true);
	$kurir=$data['rajaongkir']['results'][0]['name'];
	$kotaasal=$data['rajaongkir']['origin_details']['city_name'];
	$provinsiasal=$data['rajaongkir']['origin_details']['province'];
	$kotatujuan=$data['rajaongkir']['destination_details']['city_name'];
	$provinsitujuan=$data['rajaongkir']['destination_details']['province'];
	$berat=$data['rajaongkir']['query']['weight']/1000;

?>

<div class="container">
  <div class="row">
    
		<div class="col-md-12">
		
		<div class="table-responsive">
		  <table class="table">
		    <tr>
		      <td width="15%"><p><b>Kurir</b> </p></td>
		      <td>&nbsp;<p><b><?=$kurir?></b></p></td>
		    </tr>
		    <tr>
		      <td><p>Dari</p></td>
		      <td><p>: <?=$kotaasal.", ".$provinsiasal?></p></td>
		    </tr>
		    <tr>
		      <td><p>Tujuan</p></td>
		      <td><p>: <?=$kotatujuan.", ".$provinsitujuan?></p></td>
		    </tr>
		    <tr>
		      <td><p>Berat (Kg)</p></td>
		      <td><p>: <?=$berat?></p></td>
		    </tr>
		  </table><br>
		  <table class="table table-striped table-bordered ">
		  	<thead>
		  		<tr>
		  			<th><p>Nama Layanan</p></th>
		  			<th><p>Tarif</p></th>
		  			<th><p>ETD(Estimates Days)</p></th>
		  		</tr>
		  	</thead>
		  	<tbody>
		  		<?php
		  			foreach ($data['rajaongkir']['results'][0]['costs'] as $value) {
		  				echo "<tr>";
		  				echo "<td><p>".$value['service']."</p></td>";

		  				foreach ($value['cost'] as $tarif) {
		  					echo "<td align='right'><p>Rp " . number_format($tarif['value'],2,',','.')."</p></td>";
		  					echo "<td><p>".$tarif['etd']." </p></td>";
		  				}
		  				
		  				echo "</tr>";
		  			}
		  		?>
		  	</tbody>
		  </table>
				</div>
		</div>
	</div>
	</div>
	</div>
	