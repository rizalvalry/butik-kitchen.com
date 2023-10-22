<?php
// Upload gambar untuk User
function Uploaduser($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/user/";
    $vdir_upload1 = "../gambar/thumb_user/";
    $vdir_upload2 = "../gambar/thumb_user2/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 50;
    $dst_height = 50;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Simpan dalam versi small 150 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 150;
    $dst_height = ($dst_width / $src_width) * $src_height;

    //proses perubahan ukuran
    $im2 = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload2 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}
// Upload gambar untuk User
function Uploadseller($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "gambar/user/";
    $vdir_upload1 = "gambar/thumb_user/";
    $vdir_upload2 = "gambar/thumb_user2/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg' or $tipefile == 'image/jpg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 50;
    $dst_height = 50;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Simpan dalam versi small 150 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 150;
    $dst_height = ($dst_width / $src_width) * $src_height;

    //proses perubahan ukuran
    $im2 = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload2 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
    imagedestroy($im2);
}
// Upload gambar untuk Slide
function Uploadslide($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/slide/";
    $vdir_upload1 = "../gambar/thumb_slide/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg' or $tipefile == 'image/jpg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 900;
    $dst_height = 310;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
}

// Upload gambar untuk Produk
function Uploadproduk($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/produk/";
    $vdir_upload1 = "../gambar/thumb_produk1/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 250;
    $dst_height = 333;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
}
// Upload gambar untuk Artikel
function Uploadartikel($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/artikel/";
    $vdir_upload1 = "../gambar/thumb_artikel/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 250;
    $dst_height = 333;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
}
// Upload gambar untuk Artikel
function Uploadbanner($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/banner/";
    $vdir_upload1 = "../gambar/thumb_banner/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 300;
    $dst_height = 333;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
}
// Upload gambar untuk Galeri
function Uploadgaleri($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/galeri/";
    $vdir_upload1 = "../gambar/thumb_galeri/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 300;
    $dst_height = 300;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
    unlink("../gambar/galeri/$fupload_name");
}
// Upload gambar untuk Foto
function Uploadfoto($fupload_name, $tipefile)
{
    //direktori gambar
    $vdir_upload = "../gambar/foto/";
    $vdir_upload1 = "../gambar/thumb_foto/";
    $vfile_upload = $vdir_upload . $fupload_name;

    //Simpan gambar dalam ukuran sebenarnya
    move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload);

    //identitas file asli
    if ($tipefile == 'image/jpeg') {
        $im_src = imagecreatefromjpeg($vfile_upload);
    } else {
        $im_src = imagecreatefrompng($vfile_upload);
    }

    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi small 50 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width = 300;
    $dst_height = 300;

    //proses perubahan ukuran
    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im, $vdir_upload1 . $fupload_name);

    //Hapus gambar di memori komputer
    imagedestroy($im_src);
    imagedestroy($im);
}
