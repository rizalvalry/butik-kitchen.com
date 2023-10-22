<?php
		$query00 = $db->query("SELECT nomor_hp, nama_toko FROM profil");
		$rowcrumb = $query00->fetch_assoc();
		$query75  = $db->query("SELECT nama FROM hubungi WHERE dibuka = 'Y'");
		$row75    = $query75->fetch_assoc();
		
	?>

<!--breadcrumbs-->
<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"> Beranda /</a></li>
				<li class="active"><?php echo $row75['nama']; ?></li>
			</ol>
		</div>
	</section>
	<!--//breadcrumbs-->


	<div class="container">
		<div class="row">
			<div class="col-md-6">
			<form onsubmit="return showInput()">
				<div class="form-row">
					<div class="form-group col-md-6">
					<label for="user_input">Nama</label>
					<input type="text" class="form-control" id="user_input" placeholder="Nama" required>
					</div>
					<div class="form-group col-md-6">
					<label for="user_email">Email</label>
					<input type="email" class="form-control" id="user_email" placeholder="Email" required>
					</div>
				</div>
				<div class="form-row">

					<div class="form-group col-md-6">
					<label for="inputState">Jenis Keperluan</label>
					<select class="form-control" name="user_goal" id="user_goal" required>
									<option value=""> -- Pilih -- </option>
									<?php
										$query456       = $db->query("SELECT judul_galeri FROM galeri ORDER BY id_galeri ASC");
										while ( $row456 = $query456->fetch_assoc() ){
											echo '<option value="'.$row456['judul_galeri'].'" id="user_goal">'.$row456['judul_galeri'].'</option>';
										}
									?>
								</select>
					</select>
					</div>

				</div>
				<div class="form-group">
					<label for="user_pesan">Pesan</label>
					<textarea type="text" class="form-control" id="user_pesan" placeholder="isi pesan" required></textarea>
				</div>
				<!-- <div class="form-group">
					<div class="form-check">
					<input class="form-check-input" type="checkbox" id="gridCheck">
					<label class="form-check-label" for="gridCheck">
						Check me out
					</label>
					</div>
				</div> -->
				<a id="link2" target="_blank" onclick="showInput();" class="btn btn-danger btn-sm">Kirim Sekarang</a>
			</form>
			<div class="clear-fix"></div>
		</div>
		<div class="col-md-6">
			<div class="container">
			<?php $queryImage = $db->query("SELECT gambar from profil"); 
					$rowImages    = $queryImage->fetch_assoc();
			?>
			<img class="img-responsive" src="gambar/toko/<?= $rowImages['gambar']; ?>" width ="50%"> 
			</div>
		</div>
	</div>
</div>


<script>
var str = "<?php echo $rowcrumb['nomor_hp']; ?>";

function showInput() {

    var a = document.getElementById("user_input").value;
    var b = document.getElementById("user_email").value;
    var c = document.getElementById("user_goal").value;
    var d = document.getElementById("user_pesan").value;
    var wa = "https://api.whatsapp.com/send?phone=";
    var sap = "&text=Halo%20*butik-kitchen.com*,%20Saya%20";
	var enter = "%0A";
	
	if (a == "") {
		alert("Mohon isi nama Anda dengan benar"); 
		return false;
	}
	else if(b == "") {
		alert("Mohon isi email Anda dengan benar");
		return false;
	}
	else if(c == "") {
		alert("Mohon isi kategori keperluan");
		return false;
	}
	else if(d == "") {
		alert("Mohon isi pesan Anda");
		return false;
  	} else {
		var strLink = wa + str + sap + a + enter + b + enter + c + enter + d;
		document.getElementById("link2").setAttribute("href", strLink);
		console.log(strLink);
	}

}
</script>