<?php
/* Database connection start */
require "../../config/koneksi.php";
include "../../config/tgl_indo.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id_artikel',
	1 => 'judul_artikel',
	2 => 'tanggal'
);

// getting total number records without any search
$sql = "SELECT id_artikel, judul_artikel, tanggal";
$sql.=" FROM artikel";
$query         = $db->query($sql) or die("artikel.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id_artikel, judul_artikel, tanggal";
	$sql.=" FROM artikel";
	$sql.=" WHERE id_artikel LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR judul_artikel LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tanggal LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("gambar.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("artikel.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT id_artikel, judul_artikel, tanggal";
	$sql.=" FROM artikel";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("artikel.php: get PO");
	
}
$no=1;
$data = array();
while( $row       = $query->fetch_assoc() ) {  // preparing an array
	$tanggal      = tgl_indo( $row['tanggal'] );
	$nestedData   = array(); 
	
	$nestedData[] = '<td>
						<label><input type="checkbox" value="'.$row['id_artikel'].'" name="id[]"> '.$no.'</label>
					</td>';
	$nestedData[] = $row["judul_artikel"];
	$nestedData[] = $tanggal;
    $nestedData[] = "<td>
						<a href='?module=artikel&act=ubahartikel&id=".$row['id_artikel']."&token=".md5(md5($row['id_artikel']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>
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
