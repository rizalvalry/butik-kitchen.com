<?php
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
		switch ( $_GET['act'] ){
			default :
?>
			<form method="POST" action="modul/laporan/laporan-pdf.php" class="form-horizontal">
				<div class="row">
					<div class="col-sm-8">
						<span style="font-size : 30px;">Laporan</span> beranda / laporan
					</div>
					<div class="col-sm-4">
						<p class="pull-right">
							<a href="modul/laporan/laporan-skrg.php" class="btn btn-success"><i class="glyphicon glyphicon-download"></i> Laporan Hari Ini</a>
							<button type="submit" name="cetak" class="btn btn-info"><i class="glyphicon glyphicon-print"></i></button>
							<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=laporan';"><i class="glyphicon glyphicon-refresh"></i></button>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><i class="glyphicon glyphicon-list"></i>   Cetak Laporan</h4>	
						</div>
						<div class="panel-body">	
							<div class="form-group">
								<label class="control-label col-md-4">Dari Tanggal : </label>
								<div class="col-md-3">
									<input type="text" name="dari" class="form-control" placeholder="Dari Tanggal" id="tanggal" required />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Sampai Tanggal : </label>
								<div class="col-md-3">
									<input type="text" name="sampai" class="form-control" placeholder="Sampai Tanggal" id="tgl" required />
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="submit" name="submit" value="Cetak" class="btn btn-success">
			</form>
<?php
		}
	}
?>
