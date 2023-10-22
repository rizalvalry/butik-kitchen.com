<!DOCTYPE html>
<html lang="en">
<head>  
  <link rel="stylesheet" href="asset/select2-4.0.6-rc.1/dist/css/select2.min.css">
  <script src="asset/jquery/jquery-3.3.1.min.js"></script>
  <script src="asset/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
  <script src="asset/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>   
  <script src="asset/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>   
  <script src="asset/js/app.js"></script>
</head>
<body>
<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li>Cek Ongkir</li>

        </ul>
    </div>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <form class="form-horizontal" id="ongkir" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-3">Kota Asal:</label>
              <div class="col-sm-9">
                <select class="form-control" id="kota_asal" name="kota_asal" required="">
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Kota Tujuan</label>
              <div class="col-sm-9">          
                <select class="form-control" id="kota_tujuan" name="kota_tujuan" required="">
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Kurir</label>
              <div class="col-sm-9">          
                <select class="form-control" id="kurir" name="kurir" required="">
                  <option value="jne">JNE</option>
                  <option value="tiki">TIKI</option>
                  <option value="pos">POS INDONESIA</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Berat (Kg)</label>
              <div class="col-sm-9">          
                <input type="text" class="form-control" id="berat" name="berat" required="">
              </div>
            </div>
            <div class="form-group">        
              <div class="col-sm-offset-3 col-sm-8">
                <button type="submit" class="btn btn-default">Cek</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7" id="response_ongkir">      
    </div>
  </div>
</div>
</body>
</html>
