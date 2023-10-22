<!DOCTYPE HTML>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <br /><br /><br />
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
            <form action='mail2.php' method='post'>
                <div class="form-group">
                    <label>Domain Client</label>
                    <input type="text" class="form-control" name="domain">
                </div>
                <div class="form-group">
                    <label>Email Client</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Layanan</label>
                    <!-- <input type="text" class="form-control" name="layanan"> -->
                    <select class="form-control" name="layanan" id="layanan">
                        <option value="Web">Web</option>
                        <option value="Design">Design</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Dari</label>
                    <input type="text" class="form-control" name="dari">
                </div>
                <div class="form-group">
                    <label>Sampai</label>
                    <input type="text" class="form-control" name="sampai">
                </div>
                <div class="form-group">
                    <label>Periode</label>
                    <input type="text" class="form-control" name="periode">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga">
                </div>
                <div class="form-group">
                    <label>Diskon</label>
                    <input type="text" class="form-control" name="diskon">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control" name="total">
                </div>
                <div class="form-group">
                                    <button type='Submit'>Submit</button>
                </div>

            </form>
        </div>
        </div>
    </div>
</body>

</html>