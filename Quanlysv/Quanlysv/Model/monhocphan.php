<?php 

require_once 'Connect/connect.php';
class MonHP extends Database_ql_diem
{
	public static function ADD($text_masv,$text_tensv,$text_ngaysinh,$text_gioitinh,$text_dantoc,$text_noisinh,$text_malop)
	{
		$sql = "INSERT INTO sinhvien(ma_sv, hoten_sv, ngay_sinh, gioi_tinh, dan_toc, noi_sinh, ma_lop, passwordsv) VALUES ('$text_masv', '$text_tensv', '$text_ngaysinh', '$text_gioitinh', '$text_dantoc', '$text_noisinh', '$text_malop', 'pass123')";
		return parent::Execute($sql);
	}
	public static function id_DHP($txt_maHocphan)
	{
		$sql = "SELECT * FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Getdata($sql);
	}
	public static function Edit($txt_maHocphan,$txt_tenHocphan,$txt_stc,$txt_mahocky,$id_ma_monHp)
	{
		$sql = "UPDATE monhocphan SET ma_mon='$txt_maHocphan',ten_mon='$txt_tenHocphan',sotinchi='$txt_stc',ma_hk='$txt_mahocky' WHERE monhocphan.ma_mon='$id_ma_monHp'";
		return parent::Execute($sql);
	}
	public static function Delete($txt_maHocphan)
	{
		$sql = "DELETE FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Execute($sql);
	}
	public static function List()
	{
		$sql = "SELECT * FROM monhocphan";
		return parent::Getdata($sql);
	}
}

 ?>