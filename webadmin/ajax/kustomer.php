<?php
/* Database connection start */
require "../../config/koneksi.php";
include "../../config/tgl_indo.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id_kustomer',
	1 => 'nama_lengkap',
	2 => 'email',
	3 => 'alamat',
	4 => 'telpon',
	5 => 'tanggal',
	6 => 'jam',
	7 => 'aktif'
);

// getting total number records without any search
$sql = "SELECT id_kustomer,nama_lengkap,email,alamat,telpon,tanggal,jam,aktif";
$sql.=" FROM kustomer";
$query         = $db->query($sql) or die("kustomer.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id_kustomer,nama_lengkap,email,alamat,telpon,tanggal,jam,aktif ";
	$sql.=" FROM kustomer";
	$sql.=" WHERE id_kustomer LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama_lengkap LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR alamat LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR telpon LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tanggal LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR jam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR aktif LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("ajax-deskripsi.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("kustomer.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT id_kustomer,nama_lengkap,email,alamat,telpon,tanggal,jam,aktif";
	$sql.=" FROM kustomer";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("kustomer.php: get PO");
	
}

$no=1;
$data = array();
while( $row = $query->fetch_assoc() ) {  // preparing an array
	$tanggal      = tgl_indo($row['tanggal']);
	$nestedData   = array(); 
	$nestedData[] = '<td>
						<label><input type="checkbox" value="'.$row['id_kustomer'].'" name="id[]"> '.$no.'</label>
					</td>';
	$nestedData[] = $row["nama_lengkap"];
    $nestedData[] = "<td>
						~ $row[email] <br/>
						~ $row[alamat] <br/>
						~ $row[telpon]						 
					</td>";
	$nestedData[] = $tanggal;
	$nestedData[] = $row["jam"];
    $nestedData[] = ( $row["aktif"] == "Y") ? "Aktif" : "Tidak Aktif" ;
    $nestedData[] = "<td>
						<a href='?module=kustomer&act=ubahkustomer&id=".$row['id_kustomer']."&token=".md5(md5($row['id_kustomer']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>
				     </td>";		
	
	$data[] = $nestedData;
	$no++;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
