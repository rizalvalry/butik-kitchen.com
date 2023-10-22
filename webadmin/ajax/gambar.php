<?php
/* Database connection start */
require "../../config/koneksi.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'gambar_produk.id_gambar',
	1 => 'gambar_produk.gambar',
	2 => 'produk.nama_produk'
);

// getting total number records without any search
$sql = "SELECT gambar_produk.id_gambar, gambar_produk.gambar, produk.nama_produk";
$sql.=" FROM gambar_produk INNER JOIN produk ON gambar_produk.id_produk=produk.id_produk";
$query         = $db->query($sql) or die("gambar.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT gambar_produk.id_gambar, gambar_produk.gambar, produk.nama_produk";
	$sql.=" FROM gambar_produk INNER JOIN produk ON gambar_produk.id_produk=produk.id_produk";
	$sql.=" WHERE gambar_produk.id_gambar LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR gambar_produk.gambar LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR produk.nama_produk LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("gambar.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("gambar.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT gambar_produk.id_gambar, gambar_produk.gambar, produk.nama_produk";
	$sql.=" FROM gambar_produk INNER JOIN produk ON gambar_produk.id_produk=produk.id_produk";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("gambar.php: get PO");
	
}
$no=1;
$data = array();
while( $row       = $query->fetch_assoc() ) {  // preparing an array
	$nestedData   = array(); 
	
	$nestedData[] = '<td>
						<label><input type="checkbox" value="'.$row['id_gambar'].'" name="id[]"> '.$no.'</label>
					</td>';
	$nestedData[] = $row["nama_produk"];
	$nestedData[] = '<td>
						<img src="../gambar/gambar_produk/'.$row['gambar'].'" width="15%" height="15%" />
					</td>';
    $nestedData[] = "<td>
						<a href='?module=gambarproduk&act=ubahgambarproduk&id=".$row['id_gambar']."&token=".md5(md5($row['id_gambar']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>
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
