<?php
/* Database connection start */
require "../../config/koneksi.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'ongkos_kirim.id_ongkir',
    1 => 'pengiriman.metode_pengiriman',
	2 => 'prov.nama_prov',
	3 => 'kabkot.nama_kabkot',
	4 => 'kec.nama_kec',
	5 => 'ongkos_kirim.ongkos_kirim' 
);

// getting total number records without any search
$sql = "SELECT ongkos_kirim.id_ongkir,ongkos_kirim.ongkos_kirim,kec.nama_kec,kabkot.nama_kabkot,prov.nama_prov,pengiriman.metode_pengiriman";
$sql.=" FROM ongkos_kirim LEFT JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman LEFT JOIN kec ON ongkos_kirim.id_kec=kec.id_kec LEFT JOIN kabkot ON kec.id_kabkot=kabkot.id_kabkot LEFT JOIN prov ON kabkot.id_prov=prov.id_prov";
$query         = $db->query($sql) or die("ongkir.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT ongkos_kirim.id_ongkir,ongkos_kirim.ongkos_kirim,kec.nama_kec,kabkot.nama_kabkot,prov.nama_prov,pengiriman.metode_pengiriman";
	$sql.=" FROM ongkos_kirim LEFT JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman LEFT JOIN kec ON ongkos_kirim.id_kec=kec.id_kec LEFT JOIN kabkot ON kec.id_kabkot=kabkot.id_kabkot LEFT JOIN prov ON kabkot.id_prov=prov.id_prov";
	$sql.=" WHERE ongkos_kirim.id_ongkir LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR ongkos_kirim.ongkos_kirim LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR kec.nama_kec LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR kabkot.nama_kabkot LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR prov.nama_prov LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR pengiriman.metode_pengiriman LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("ongkir.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("ongkir.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT ongkos_kirim.id_ongkir,ongkos_kirim.ongkos_kirim,kec.nama_kec,kabkot.nama_kabkot,prov.nama_prov,pengiriman.metode_pengiriman";
	$sql.=" FROM ongkos_kirim LEFT JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman LEFT JOIN kec ON ongkos_kirim.id_kec=kec.id_kec LEFT JOIN kabkot ON kec.id_kabkot=kabkot.id_kabkot LEFT JOIN prov ON kabkot.id_prov=prov.id_prov";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("ongkir.php: get PO");
	
}

$data = array();
$no =1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = "<td><label><input type='checkbox' name='id[]' value='$row[id_ongkir]' /> $no</label></td>";
	$nestedData[] = $row["metode_pengiriman"];
	$nestedData[] = $row["nama_prov"];
	$nestedData[] = $row["nama_kabkot"];
    $nestedData[] = $row["nama_kec"];
	$nestedData[] = $row["ongkos_kirim"];		
	$nestedData[] = "<td>
						<a href='?module=ongkir&act=ubahongkir&id=$row[id_ongkir]&token=".md5(md5($row['id_ongkir']).md5('H3ndri@27'))."' class='btn btn-primary'><i class='glyphicon glyphicon-pencil'></i></a> 
					</td>";		
	$no++;
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
