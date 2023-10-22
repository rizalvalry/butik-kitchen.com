<?php
/* Database connection start */
require "../../config/koneksi.php";
include "../../config/tgl_indo.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'gambar',
	1 => 'id_produk',
	2 => 'nama_produk',
	3 => 'berat',
	4 => 'harga',
	5 => 'diskon',
	6 => 'stok',
	7 => 'tgl_masuk',
	8 => 'aktif'
);

// getting total number records without any search
$sql = "SELECT id_produk,gambar,nama_produk,berat,harga,diskon,stok,tgl_masuk,aktif";
$sql.=" FROM produk";
$query         = $db->query($sql) or die("produk.php: get InventoryItems");
$totalData     = $query->num_rows;
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id_produk,gambar,nama_produk,berat,harga,diskon,stok,tgl_masuk,aktif";
	$sql.=" FROM produk";
	$sql.=" WHERE id_produk LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR gambar LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama_produk LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR berat LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR harga LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR diskon LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR stok LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tgl_masuk LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR aktif LIKE '".$requestData['search']['value']."%' ";
	$query         = $db->query($sql) or die("ajax-deskripsi.php: get PO");
	$totalFiltered = $query->num_rows; // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = $db->query($sql) or die("produk.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT id_produk,gambar,nama_produk,berat,harga,diskon,stok,tgl_masuk,aktif";
	$sql.=" FROM produk";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query = $db->query($sql) or die("produk.php: get PO");
	
}
$no=1;
$data = array();
while( $row       = $query->fetch_assoc() ) {  // preparing an array
	$tanggal      = tgl_indo($row['tgl_masuk']);
	$nestedData   = array(); 
	$nestedData[] = '<td>
						<label><input type="checkbox" value="'.$row['id_produk'].'" name="id[]"> '.$no.'</label>
					</td>';
	$nestedData[] = '<td>
						<img src="../gambar/thumb_produk1/'.$row['gambar'].'" width="50%" height="50%" />
					</td>';
	$nestedData[] = $row["nama_produk"];
	$nestedData[] = $row["berat"];
	$nestedData[] = $row["harga"];
	$nestedData[] = $row["diskon"];
	$nestedData[] = $row["stok"];
	$nestedData[] = $tanggal;
	$nestedData[] = ( $row["aktif"] == "Y" ) ? "Aktif" : "Tidak Aktif";
    $nestedData[] = "<td>
						<a href='?module=produk&act=ubahproduk&id=".$row['id_produk']."&token=".md5(md5($row['id_produk']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>
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
