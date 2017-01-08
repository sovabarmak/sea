<?php
header('Content-Type: text/html; charset=utf-8');
if (isset($_POST["d"])) {
	$d = $_POST["d"];
        switch ($d) {
        case "add":
            add_bron($_POST["cat_id"], $_POST["unit_id"], $_POST["num_id"], $_POST["start"], $_POST["end"], $_POST["prim"],$_POST['booked_date'],$_POST['fio'],$_POST['deposit'],$_POST['nomer'],$_POST['etags'],$_POST['etag'],$_POST['people'],$_POST['childs'],$_POST['childs_years'],$_POST['pet'],$_POST['nomer_bron'],$_POST['days'],$_POST['sum_per'],$_POST['period1'],$_POST['period2'],$_POST['period3'],$_POST['period4'],$_POST['total']);
            break;
        case "change":
            change_bron($_POST["id"], $_POST["start"], $_POST["end"], $_POST["prim"],$_POST['booked_date'],$_POST['fio'],$_POST['deposit'],$_POST['nomer'],$_POST['etags'],$_POST['etag'],$_POST['people'],$_POST['childs'],$_POST['childs_years'],$_POST['pet'],$_POST['nomer_bron'],$_POST['days'],$_POST['sum_per'],$_POST['period1'],$_POST['period2'],$_POST['period3'],$_POST['period4'],$_POST['total']);
            break;
        case "del":
            del_bron($_POST["id"]);
            break;
        }
}
    function add_bron($cat_id, $unit_id, $num_id, $start, $end, $note,$date_booked,$fio,$deposit,$nomer,$etags,$etag,$people,$childs,$childs_years,$pet,$nomer_bron,$days,$sum_per,$period1,$period2,$period3,$period4,$total){
		$link=mysql_connect("sovabarm.mysql.ukraine.com.ua", "sovabarm_sea", "yknp8qkv");
		$db_selected=mysql_select_db("sovabarm_sea", $link);
		mysql_query("SET NAMES 'utf8'"); 
		$strSQL = 'INSERT INTO g6z53_objcreate_bookings(cat_id, unit_id, num_id, date_from, date_to, paid, comments, ordering,date_booked,fio,deposit,nomer,etags,etag,people,childs,childs_years,pet,nomer_bron,days,sum_per,period1,period2,period3,period4,total) VALUES("'.$cat_id.'","'.$unit_id.'","'.$num_id.'","'.$start.'","'.$end.'","1","'.$note.'","1","'.$date_booked.'","'.$fio.'","'.$deposit.'","'.$nomer.'","'.$etags.'","'.$etag.'","'.$people.'","'.$childs.'","'.$childs_years.'","'.$pet.'","'.$nomer_bron.'","'.$days.'","'.$sum_per.'","'.$period1.'","'.$period2.'","'.$period3.'","'.$period4.'","'.$total.'")';
		$rs = mysql_query($strSQL);
		if (!$rs) {die('Неверный запрос: ' . mysql_error());}
		mysql_close();
	}
    function change_bron($id, $start, $end, $note,$date_booked,$fio,$deposit,$nomer,$etags,$etag,$people,$childs,$childs_years,$pet,$nomer_bron,$days,$sum_per,$period1,$period2,$period3,$period4,$total) {
		$link=mysql_connect("sovabarm.mysql.ukraine.com.ua", "sovabarm_sea", "yknp8qkv");
		$db_selected=mysql_select_db("sovabarm_sea", $link);
		mysql_query("SET NAMES 'utf8'"); 
		$strSQL= "UPDATE g6z53_objcreate_bookings SET date_from='$start', date_to='$end', comments='$note',date_booked='$date_booked',fio='$fio',deposit='$deposit',nomer='$nomer',etags='$etags',etag='$etag',people='$people',childs='$childs',childs_years='$childs_years',pet='$pet',nomer_bron='$nomer_bron',days='$days',sum_per='$sum_per',period1='$period1',period2='$period2',period3='$period3',period4='$period4',total='$total' WHERE id='$id'";
		mysql_query($strSQL);
		mysql_close();
    }
    function del_bron($id) {
$link=mysql_connect("sovabarm.mysql.ukraine.com.ua", "sovabarm_sea", "yknp8qkv");
$db_selected=mysql_select_db("sovabarm_sea", $link);
$strSQL = "DELETE FROM g6z53_objcreate_bookings WHERE id =".$id;
mysql_query($strSQL);
mysql_close();
    }
?>