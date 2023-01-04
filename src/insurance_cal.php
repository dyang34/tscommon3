<?
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include_once $root_dir."/config/get_site_config_member_no.php";
include $root_dir."/tscommon3/include/hana_check_ajax.php";

$plan_array=array();
$x=0;

//2019-07-03 해외 여행 80대(보험나이) 1개월 이상 보험가입 금지 - 박우철
$start_date = addslashes(fnFilterString($_POST['start_date']));
$start_hour = addslashes(fnFilterString($_POST['start_hour']));

$end_date = addslashes(fnFilterString($_POST['end_date']));
$end_hour = addslashes(fnFilterString($_POST['end_hour']));

$start_date_arr=explode("-",$start_date);
$start_time=mktime($start_hour,"00","00",$start_date_arr[1],$start_date_arr[2],$start_date_arr[0]);

$end_date_arr=explode("-",$end_date);
$end_time=mktime($end_hour,"00","00",$end_date_arr[1],$end_date_arr[2],$end_date_arr[0]);

// 해외 80세 이상 관광은 보험의 일정 (1개월)이 아닌 순수 30일을 가져와야 함. 2019-08-29
$rl_term_day = real_period($start_date." ".$start_hour.":00:00", $end_date." ".$end_hour.":00:00");

//2019-07-24 $term_day 상품별 여행기간 계산 추가 - 박우철
//$term_day=ceil(($end_time-$start_time)/86400);
$term_day = travel_period($start_date." ".$start_hour.":00:00", $end_date." ".$end_hour.":00:00"); 
//2019-07-24 $term_day 상품별 여행기간 계산 추가 - 박우철
//2019-07-03 해외 여행 80대(보험나이) 1개월 이상 보험가입 금지 - 박우철

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$cur_date=date("Y-m-d");
$cal_age_text="";
$cal_type_array=array();


for ($i=0;$i<count($_POST['jumin_1']);$i++) {
	if ($_POST['jumin_1'][$i]!='') {

		if (addslashes(fnFilterString($_POST['send_type']))=="1") {
			
		    if (substr($_POST['jumin_2'][$i],0,1) == "1" ||
		        substr($_POST['jumin_2'][$i],0,1) == "2" ||
		        substr($_POST['jumin_2'][$i],0,1) == "3" ||
		        substr($_POST['jumin_2'][$i],0,1) == "4"){
		            $jumin_check=resnoCheck($_POST['jumin_1'][$i],$_POST['jumin_2'][$i]);
		    } else {
		        $jumin_check=foreignerCheck($_POST['jumin_1'][$i],$_POST['jumin_2'][$i]);
		        //$jumin_check=true;
		    }

			if ($jumin_check==false) {
				$json_code = array('result'=>'false','msg'=>'주민번호를 다시 확인해 주세요.');
				echo json_encode($json_code);
				exit;
			}

			for ($j=0;$j<count($_POST['jumin_1']);$j++) { 
				if ($i!=$j) {
					if ($_POST['jumin_1'][$i]==$_POST['jumin_1'][$j] && $_POST['jumin_2'][$i]==$_POST['jumin_2'][$j]) {
						$json_code = array('result'=>'false','msg'=>'동일한 주민등록 번호가 등록되어 있습니다.');
						echo json_encode($json_code);
						exit;
					}
				}
			}

			$sex_type=substr($_POST['jumin_2'][$i],0,1);

			if ($sex_type=="1" || $sex_type=="2" || $sex_type=="5" || $sex_type=="6") {
			    $birth_year="19".substr($_POST['jumin_1'][$i],0,2);
			    $birth_month=substr($_POST['jumin_1'][$i],2,2);
			    $birth_day=substr($_POST['jumin_1'][$i],4,2);
			    
			} elseif ($sex_type=="3" || $sex_type=="4" || $sex_type=="7" || $sex_type=="8") {
			    $birth_year="20".substr($_POST['jumin_1'][$i],0,2);
			    $birth_month=substr($_POST['jumin_1'][$i],2,2);
			    $birth_day=substr($_POST['jumin_1'][$i],4,2);
			}
			
			if ($sex_type=="1" || $sex_type=="3" || $sex_type=="5" || $sex_type=="7") {
			    $sex='1';
			} elseif ($sex_type=="2" || $sex_type=="4" || $sex_type=="6" || $sex_type=="8") {
			    $sex='2';
			}
			

		} elseif (addslashes(fnFilterString($_POST['send_type']))=="2") {
			$sex_type=substr($_POST['jumin_2'][$i],0,1);

			$birth_year=substr($_POST['jumin_1'][$i],0,4);
			$birth_month=substr($_POST['jumin_1'][$i],4,2);
			$birth_day=substr($_POST['jumin_1'][$i],6,2);
			
			if ($sex_type=="1") {
				$sex='1';
			} elseif ($sex_type=="2") {
				$sex='2';
			}
		}
		
		$birth_date=$birth_year."-".$birth_month."-".$birth_day;
		
		list($cal_age,$term_year) = age_cal($cur_date,$birth_date);
		
		if ($cal_age > 100) {
		    $cal_age=100;
		}
		
		if ($tripType=="2") {
			if ($cal_age >= 0 && $cal_age <= 14) {
				$cal_type="1";
			} elseif ($cal_age >= 15 && $cal_age <= 70) {
				$cal_type="2";
				
				if ($cal_age=="15") {
				    if ($term_year=="14") {
				        $cal_type="1";
				    }
				}
			} elseif ($cal_age >= 71 && $cal_age <= 79) {
				$cal_type="3";
			} elseif ($cal_age >= 80) {
				$cal_type="4";
			}
			
			if($cal_type == "4"){
				// 2019-08-29 $rl_term_day -> 추가 여행기간 변수 해외 여행시 80세이상 고객은 30일 까지만 보험 가입이 가능한데 $term_day는 27일 이상은 1개월로 전환이 되어 추가 함. 
				if($cal_type == "4" && $rl_term_day > 30){
					$json_code = array('result'=>'false','msg'=>'여행자보험 가입시 80세이상 고객님은  최대 30일까지만 가입이 가능합니다. 31일 이상 가입은 고객센터로 연락주세요. (1800-9010)');
					echo json_encode($json_code);
					exit;
				}
				//2019-07-03 해외 여행 $tripType = 2 나이 80 이상 $cal_type = 3  여행 기간 $term_day >= 30
			}

		} elseif ($tripType=="1") {
			if ($cal_age >= 0 && $cal_age <= 14) {
				$cal_type="1";
			} elseif ($cal_age >= 15 && $cal_age <= 79) {
				$cal_type="2";
				
				if ($cal_age=="15") {
				    if ($term_year=="14") {
				        $cal_type="1";
				    }
				}
			} elseif ($cal_age >= 80 && $cal_age <= 100) {
				$cal_type="3";
			}
		}

		$cal_type_array[$i]=$cal_type;
	}
}

$cal_type_query="";

foreach($cal_type_array as $k => $v){
  if ($cal_type_query=="") {
	$cal_type_query="(".$v;
  } else {
	  $cal_type_query=$cal_type_query.",".$v;
  }
}

if ($cal_type_query!='') {
	$cal_type_query=$cal_type_query.")";
}

if($tripType == '1' && $cal_type == '3'){
	$type_sql = " and plan_type = '1' ";
} else {
	$type_sql = "";
}

if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
	$sql="select * from plan_code_hana where trip_type='".$tripType."' and company_type=1 and member_no='".$site_config_member_no."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'thaiPass') === 0) {
	$sql = "select * from plan_code_hana_thai where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'kamboPass') === 0) {
	$sql = "select * from plan_code_hana_kam where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'indonPass') === 0) {
	$sql = "select * from plan_code_hana_indonesia where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'philPass') === 0) {
	$sql = "select * from plan_code_hana_phil where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'malaPass') === 0) {
	$sql = "select * from plan_code_hana_mala where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'thaiPass5') === 0) {
	$sql = "select * from plan_code_hana_thai_5 where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

if(strcmp($thai_chk,'thaiPass1') === 0) {
	$sql = "select * from plan_code_hana_thai_1 where trip_type='".$tripType."' and cal_type in ".$cal_type_query." group by plan_title  order by no asc";
}

//echo "<!--".$sql."-->";
$result=mysql_query($sql);
//한글만 나오게

$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';
while($row=mysql_fetch_array($result)) {

	if(strcmp($thai_chk,'thaiPass1') === 0) {
		$plan_title = $row['plan_title'];
	}else{
		preg_match_all($pattern, $row['plan_title'], $match);
		$plan_title = implode('', $match[0]);
	}
	$plan_array[$x]['plan_code']=$row['plan_code'];
	$plan_array[$x]['plan_type']=$row['plan_type'];
	$plan_array[$x]['plan_title']=$plan_title;

	$x++;
}

$json_code = array('result'=>'true','msg'=>$plan_array);
echo json_encode($json_code);
exit;
?>