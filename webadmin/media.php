<?php
    ob_start();
    error_reporting(0);
	session_start();
	if( !empty($_SESSION['email'])  AND !empty($_SESSION['level']) AND $_SESSION['login'] == 1){
    require "../config/koneksi.php";
	include "../config/thumb.php";
	date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$_query = $db->prepare("SELECT foto,nama_lengkap FROM user WHERE id_user=?");
		$_query->bind_param("i", $_email);
		$_email = $_SESSION['id'];
		$_query->execute();
		$_result= $_query->get_result();
		$_row   = $_result->fetch_assoc();
		$tahun  = date("Y");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Halaman Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="assets/select/css/select2.min.css"/>
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<link href="assets/dataTables/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- //lined-icons -->
<link rel="stlyesheet" href="assets/datepicker/css/bootstrap-datepicker3.css">
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/script.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="?module=home">Admin <span>Panel</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="?module=home"><i class="glyphicon glyphicon-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
				<?php
					if($_SESSION['level']=="Admin"){
				?>
					
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li><a href="media.php?module=user" class="<?php if($_GET['module']=='user') echo "active"; ?>"><i class="fa fa-user"></i><span>Kelola Seller</span></a></li>
						<?php
							$query1  = $db->prepare("SELECT id_main,nama_menu,icon FROM menuutama WHERE aktif=? AND lokasi=? ORDER BY urutan ASC");
							$query1->bind_param("ss", $aktif1,$lokasi1);
							$aktif1  = "Y";
							$lokasi1 = "Admin";
							$query1->execute();
							$result1 = $query1->get_result();
							while ($row1 = $result1->fetch_assoc())
							{
						?>
						<li class="menu-list">
							<a href="#"><i class="<?php echo $row1['icon']; ?>"></i>
								<span><?php echo $row1['nama_menu']; ?></span></a>
								<ul class="sub-menu-list">
									<?php
										$query2  = $db->prepare("SELECT id_sub,nama_sub,link_sub FROM submenu WHERE id_main=? AND aktif=? ORDER BY nama_sub ASC");
										$query2->bind_param("ss",$id_main2,$aktif2);
										$aktif2  = "Y";
										$id_main2= $row1['id_main'];
										$query2->execute();
										$result2 = $query2->get_result();
										while ($row2 = $result2->fetch_assoc())
										{
									?>
									<li><a href="<?php echo $row2['link_sub']; ?>"><?php echo $row2['nama_sub']; ?></a> </li>
									<?php
										}
									?>
								</ul>
						</li>
						<?php
							}
						?>
					</ul>
					
				<?php
					} else {
				?>
					<ul class="nav nav-pills nav-stacked custom-nav">
						<?php
							$query3  = $db->prepare("SELECT id_main,nama_menu,icon FROM menuutama WHERE aktif=? AND lokasi=? AND user=? ORDER BY urutan ASC");
							$query3->bind_param("sss", $aktif3,$lokasi3,$user3);
							$aktif3  = "Y";
							$lokasi3 = "Admin";
							$user3   = "Y";
							$query3->execute();
							$result3 = $query3->get_result();
							while ($row3 = $result3->fetch_assoc())
							{
						?>
						<li class="menu-list">
							<a href="#"><i class="<?php echo $row3['icon']; ?>"></i>
								<span><?php echo $row3['nama_menu']; ?></span></a>
								<ul class="sub-menu-list">
									<?php
										$query4  = $db->prepare("SELECT id_sub,nama_sub,link_sub FROM submenu WHERE id_main=? AND aktif=? AND user=? ORDER BY nama_sub ASC");
										$query4->bind_param("sss",$id_main4,$aktif4,$user4);
										$aktif4  = "Y";
										$id_main4= $row3['id_main'];
										$user4   = "Y";
										$query4->execute();
										$result4 = $query4->get_result();
										while ($row4 = $result4->fetch_assoc())
										{
									?>
									<li><a href="<?php echo $row4['link_sub']; ?>"><?php echo $row4['nama_sub']; ?></a> </li>
									<?php
										}
									?>
								</ul>
						</li>
						<?php
							}
						?>
					</ul>
				<?php
						}
				?>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span><img src="../gambar/thumb_user/<?php echo $_row['foto']; ?>" class="img-thumbnail" /> </span> 
										 <div class="user-name">
											<p>Hallo !<span><?php echo $_row['nama_lengkap']; ?></span></p>
										 </div>
										 <i class="fa fa-chevron-down"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu"> 
									<li> <a href="?module=profiluser"><i class="fa fa-user"></i>Profil</a> </li> 
									<li> <a href="?module=upass"><i class="fa fa-cog"></i> Pengaturan</a> </li>
									<li> <a href="keluar.php"><i class="fa fa-sign-out"></i> Keluar</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>         	
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
			<div id="page-wrapper">
				<div class="graphs">
					<?php
						include "konten.php";
					?>
				</div>
			<!--body wrapper start-->
			</div>
			 <!--body wrapper end-->
		</div>
        <!--footer section start-->
			<footer>
			   <p><a href="http://www.valryhouse.com" target="blank">valryhouse.com</a> &copy 2020 - <?php echo $tahun; ?> . Hak Cipta Dilindungi Undang-Undang <br/> Versi 1.0</p>
			</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>
  
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="assets/dataTables/js/jquery.dataTables.min.js"></script>
<script src="assets/dataTables/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/tinymce/tinymce.min.js"></script>
<script src="assets/select/js/select2.min.js"></script>
<script src="assets/datepicker/js/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>

<script>
    tinymce.init({
        selector: "#tinymce_basic",
        plugins: [
			"advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
	tinymce.init({
        selector: "#tinymce_basic_two",
        plugins: [
			"advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>

<script type="text/javascript">
	$('#example1').dataTable({
		"columnDefs": [ {"targets": 0,"orderable": false} ],
		"aaSorting": [],
		"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
		"oLanguage": { 
			"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
			"sLengthMenu": 'Tampilkan _MENU_ Data',   
			"sInfoEmpty": 'Tidak ada Data.',
			"sSearch": 'Pencarian:',
			"sEmptyTable": 'Tidak ada Data di dalam Database',
			"oPaginate": {
				"sNext": 'Selanjutnya',
				"sLast": 'Terakhir',
				"sFirst": 'Pertama',
				"sPrevious": 'Sebelumnya'
			}
		}
	});
</script>
<script>
	$(document).ready(function () {
		$("#select").select2({
			placeholder: "Pilih Menu Utama"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select2").select2({
			placeholder: "Pilih Kategori Produk"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select3").select2({
			placeholder: "Pilih Metode Pengiriman"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select4").select2({
			placeholder: "Pilih Kategori Produk"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select5").select2({
			placeholder: "Pilih Produk"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select6").select2({
			placeholder: "Pilih Kategori Artikel"
		});
	});
</script>
<script>
	$(document).ready(function () {
		$("#select7").select2({
			placeholder: "Pilih Galeri Foto"
		});
	});
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#example').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 1, 'asc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/kustomer.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#ongkir').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 2, 'asc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/ongkir.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#komentar').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 1, 'desc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/komentar.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#produk').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 1, 'desc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/produk.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#order').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 1, 'desc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/order.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#gambar').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 2, 'asc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/gambar.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$(document).ready(function() {
		var dataTable = $('#artikel').DataTable( {
			"columnDefs": [ {"targets": 0,"orderable": false} ],
			"aaSorting": [[ 0, 'desc' ]],
			"aLengthMenu": [[10, 25, 50, 100, 250, 500, -1], [10, 25, 50, 100, 250, 500, 'All']],
			"processing": true,
			"serverSide": true,
			"oLanguage": { 
				"sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
				"sLengthMenu": 'Tampilkan _MENU_ Data',   
				"sInfoEmpty": 'Tidak ada Data.',
				"sSearch": 'Pencarian:',
				"sEmptyTable": 'Tidak ada Data di dalam Database',
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
			"ajax":{
				url :"ajax/artikel.php", // json datasource
				type: "post",  // method  , by default get
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#lookup_processing").css("display","none");
				}
			}
		} );
	} );
</script>
<script>
	$('#semua').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
		 $(':checkbox').each(function() {
            this.checked = false;                        
        });
	}
});
</script>
<script>
	function readURL(input) { // Mulai membaca inputan gambar
		if (input.files && input.files[0]) {
			var reader = new FileReader(); // Membuat variabel reader untuk API FileReader
		 
			reader.onload = function (e) { // Mulai pembacaan file
				$('#preview_gambar') // Tampilkan gambar yang dibaca ke area id #preview_gambar
				.attr('src', e.target.result)
				.width(150); // Menentukan lebar gambar preview (dalam pixel)
				//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
			};
		 
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<script type="text/javascript">
	function validateForm()
	{
		function hasExtension(inputID, exts) {
			var fileName = document.getElementById(inputID).value;
			return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
		}
		if(!hasExtension('data', ['.xls'])){
			alert("Hanya file XLS (Excel 2003) yang diijinkan.");
			return false;
		}
	}
</script>
<script type="text/javascript">
	$('#tanggal').datepicker({
		format : "yyyy-mm-dd",
		autoclose:true
	});        
</script>
<script type="text/javascript">
	$('#tgl').datepicker({
		format : "yyyy-mm-dd",
		autoclose:true
	});
</script>

</body>
</html>
<?php
	} else {
	    	header('location:blank.php?error='.md5('Hendri@27').'');
	}
?>