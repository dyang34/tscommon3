<?
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include_once $root_dir."/config/get_site_config_member_no.php";
include $root_dir."/tscommon3/include/hana_check_ajax.php";

$msg=array();
$x=0;

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$sql_check="select * from hana_plan_tmp where session_key='".$_SESSION['s_session_key']."'";
$result_check=mysql_query($sql_check);
$row_check=mysql_fetch_array($result_check);

if ($row_check['no']!='') {
	$sql_delete="delete from hana_plan_tmp where session_key='".$_SESSION['s_session_key']."'";
	mysql_query($sql_delete);

	$sql_delete="delete from hana_plan_member_tmp where tmp_no='".$row_check['no']."'";
	mysql_query($sql_delete);
}

$start_date = addslashes(fnFilterString($_POST['start_date']));
$start_hour = addslashes(fnFilterString($_POST['start_hour']));

$end_date = addslashes(fnFilterString($_POST['end_date']));
$end_hour = addslashes(fnFilterString($_POST['end_hour']));

$start_date_arr=explode("-",$start_date);
$start_time=mktime($start_hour,"00","00",$start_date_arr[1],$start_date_arr[2],$start_date_arr[0]);

$end_date_arr=explode("-",$end_date);
$end_time=mktime($end_hour,"00","00",$end_date_arr[1],$end_date_arr[2],$end_date_arr[0]);

$term_day=ceil(($end_time-$start_time)/86400);

if ($tripType=="1") {
	if ($term_day > 30) {
		$term_day=30;
	}
} elseif ($tripType=="2") {
	if ($term_day > 90) {
		$term_day = 90;
	}
}

$plan_type = addslashes(fnFilterString($_POST['plan_type']));
$cur_date=date("Y-m-d");
$total_price="0";

$sql_tmp="insert into hana_plan_tmp set
			session_key='".$_SESSION['s_session_key']."',
			member_no='".$member_no."',
			trip_type='".$tripType."',
			order_type='".$send_type."',
			nation_no='".$nation."',
			trip_purpose='".$trip_purpose."',
			start_date='".$start_date."',
			start_hour='".$start_hour."',
			end_date='".$end_date."',
			end_hour='".$end_hour."',
			term_day='".$term_day."',
			join_cnt='".$join_cnt."',
			plan_type='".$plan_type."',
			referer_type='1',
			regdate='".time()."'

		";	
mysql_query($sql_tmp);
$tmp_no = mysql_insert_id();

$main_check="";

for ($i=0;$i<count($_POST['jumin_1']);$i++) {
	
	if ($_POST['jumin_1'][$i]!='') {

		$sex_type=substr($_POST['jumin_2'][$i],0,1);

		$birth_year=substr($_POST['jumin_1'][$i],0,4);
		$birth_month=substr($_POST['jumin_1'][$i],4,2);
		$birth_day=substr($_POST['jumin_1'][$i],6,2);
		
		if ($sex_type=="1") {
			$sex='1';
		} elseif ($sex_type=="2") {
			$sex='2';
		}

		$birth_date=$birth_year."-".$birth_month."-".$birth_day;
		
		list($cal_age,$term_year) = age_cal($cur_date,$birth_date);
		
		if ($cal_age > 100) {
		    $cal_age_cal=100;
		} else {
		    $cal_age_cal=$cal_age;
		}
		

		if ($main_check=="") {
			$main_check="Y";
		} else {
			$main_check="N";
		}
		
		
		if ($cal_age=="15") {
		    if ($term_year=="14") {
		        $sql_r="select plan_code from plan_code_hana where member_no='".$site_config_member_no."' and company_type=1 and trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
		        $result_r=mysql_query($sql_r);
		        $row_r=mysql_fetch_array($result_r);
		        
		        $plan_code=$row_r['plan_code'];
		    } else {
		        $sql_r="select plan_code from plan_code_hana where member_no='".$site_config_member_no."' and company_type=1 and trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
		        $result_r=mysql_query($sql_r);
		        $row_r=mysql_fetch_array($result_r);
		        
		        $plan_code=$row_r['plan_code'];
		    }
		}
		
		$add_query="";
		
		if ($plan_code!="") {
		    $add_query=" and plan_code='".$plan_code."'";
		}
		
		$select_term="select plan_code, price from plan_code_price_hana where trip_type='".$tripType."' and company_type=1 and member_no='".$site_config_member_no."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age_cal."' ".$add_query." order by term_day asc limit 1";
		
		$result_term=mysql_query($select_term);
		$row_term=mysql_fetch_array($result_term);

			$total_price=$total_price+$row_term['price'];

		$jumin_1 =encode_pass(addslashes(fnFilterString($_POST['jumin_1'][$i])),$pass_key);
		$jumin_2 ="";
		
		if ($_POST['hphone1'][$i]!='') {
			$hphone=encode_pass(addslashes(fnFilterString($_POST['hphone1'][$i])).addslashes(fnFilterString($_POST['hphone2'][$i])).addslashes(fnFilterString($_POST['hphone3'][$i])),$pass_key);
		} else {
			$hphone="";
		}

		if ($_POST['email1'][$i]!='' && $_POST['email2'][$i]!='') {
			$email=encode_pass(addslashes(fnFilterString($_POST['email1'][$i]))."@".addslashes(fnFilterString($_POST['email2'][$i])),$pass_key);
		} else {
			$email="";
		}

		$sql_tmp="insert into hana_plan_member_tmp set
			tmp_no='".$tmp_no."',
			main_check='".$main_check."',
			name='".addslashes(fnFilterString($_POST['input_name'][$i]))."',
			jumin_1='".$jumin_1."',
			jumin_2='".$jumin_2."',
			hphone='".$hphone."',
			email='".$email."',
			plan_code='".$row_term['plan_code']."',
			plan_price='".$row_term['price']."',
			sex='".$sex."',
			age='".$cal_age."',
            plan_title = (select plan_title from plan_code_hana where plan_code = '".$row_term['plan_code']."' and company_type=1 and  member_no='".$site_config_member_no."'),
			plan_title_src = (select plan_title_src from plan_code_hana where plan_code = '".$row_term['plan_code']."' and company_type=1 and  member_no='".$site_config_member_no."'),
			thai_chk = '".$thai_chk."'
		";	
		mysql_query($sql_tmp);
	}
}


$json_code = array('result'=>'true','msg'=>'success');
echo json_encode($json_code);
exit;

?>
