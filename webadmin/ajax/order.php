<?php
/* Database connection start */
require "../../config/koneksi.php";
include "../../config/tgl_indo.php";
date_default_timezone_set('Asia/Jakarta');
$tahun = date("Y");

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'orders.status_orders',
	1 => 'orders.id_orders',
	2 => 'orders.tanggal',
	3 => 'orders.jam',
	4 => 'kustomer.nama_lengkap'
);

// getting total number records without any search
$sql = "SELECT orders.id_orders, orders.status_orders, orders.tanggal, orders.jam, kustomer.nama_lengkap";
$sql.=" FROM orders LEFT JOIN kustomer ON orders.id_kustomer=kustomer.id_kustomer";
$query         = $db->query($sql) or die("order.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT orders.id_orders, orders.status_orders, orders.tanggal, orders.jam, kustomer.nama_lengkap";
	$sql.=" FROM orders LEFT JOIN kustomer ON orders.id_kustomer=kustomer.id_kustomer";
	$sql.=" WHERE orders.id_orders LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR orders.status_orders LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR orders.tanggal LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR orders.jam LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR kustomer.nama_lengkap LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("order.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("order.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT orders.id_orders, orders.status_orders, orders.tanggal, orders.jam, kustomer.nama_lengkap";
	$sql.=" FROM orders LEFT JOIN kustomer ON orders.id_kustomer=kustomer.id_kustomer";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("order.php: get PO");
	
}
$no=1;
$data = array();
while( $row       = $query->fetch_assoc() ) {  // preparing an array
	$tanggal      = tgl_indo($row['tanggal']);
	$nestedData   = array(); 
	$nestedData[] = '<td>
						<label><input type="checkbox" value="'.$row['id_orders'].'" name="id[]"> '.$no.'</label>
					</td>';
	$nestedData[] = '#'.$tahun.'-'.$row["id_orders"];
	$nestedData[] = $row["nama_lengkap"];
	$nestedData[] = $tanggal;
	$nestedData[] = $row["jam"].' WIB';
	$nestedData[] = $row["status_orders"];
    $nestedData[] = "<td>
						<a href='?module=order&act=detailorder&id=".$row['id_orders']."&token=".md5(md5($row['id_orders']).md5('H3ndri@27'))."' class='btn btn-primary btn-xs' >Detail</a>
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
