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

$start_date = addslashes(fnFilterString($_POST['start_date']));
$start_hour = addslashes(fnFilterString($_POST['start_hour']));

$end_date = addslashes(fnFilterString($_POST['end_date']));
$end_hour = addslashes(fnFilterString($_POST['end_hour']));

$start_date_arr=explode("-",$start_date);
$start_time=mktime($start_hour,"00","00",$start_date_arr[1],$start_date_arr[2],$start_date_arr[0]);

$end_date_arr=explode("-",$end_date);
$end_time=mktime($end_hour,"00","00",$end_date_arr[1],$end_date_arr[2],$end_date_arr[0]);

//2019-07-24 $term_day 상품별 여행기간 계산 추가 - 박우철
//$term_day=ceil(($end_time-$start_time)/86400);
$term_day = travel_period($start_date." ".$start_hour.":00:00", $end_date." ".$end_hour.":00:00"); 
//2019-07-24 $term_day 상품별 여행기간 계산 추가 - 박우철

if ($tripType=="1") {
	if ($term_day > 30) {
		$term_day=30;
	}
} elseif ($tripType=="2") {
	if ($term_day > 90) {
		$term_day = 90;
	}
}

if ($end_date=="") {
	$json_code = array('result'=>'false','msg'=>'여행 도착일을 입력하세요.');
	echo json_encode($json_code);
	exit;
}

if ($term_day<"0") {
	$json_code = array('result'=>'false','msg'=>'여행기간을 다시 확인해 주세요.');
	echo json_encode($json_code);
	exit;
}

$plan_type = addslashes(fnFilterString($_POST['plan_type']));
$cur_date=date("Y-m-d");
$total_price="0";

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
                
        if ($cal_age=="15") {
            if ($term_year=="14") {
				
	 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
					$sql_r="select plan_code from plan_code_hana where member_no='".$site_config_member_no."' and company_type=1 and trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}

				if(strcmp($thai_chk,'thaiPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'kamboPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_kam where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'indonPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_indonesia where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'philPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_phil where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'malaPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_mala where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'thaiPass5') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai_5 where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'thaiPass1') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai_1 where trip_type='".$tripType."' and cal_type='1' and plan_type like '%".$plan_type."%'";
				}

				
				$result_r=mysql_query($sql_r);
                $row_r=mysql_fetch_array($result_r);
                
                $plan_code[$i]=$row_r['plan_code'];
            } else {
				
			 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
					$sql_r="select plan_code from plan_code_hana where member_no='".$site_config_member_no."' and company_type=1 and trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}

				if(strcmp($thai_chk,'thaiPass') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'kamboPass') === 0) {	
					$sql_r="select plan_code from plan_code_hana_kam where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'indonPass') === 0) {	
					$sql_r="select plan_code from plan_code_hana_indonesia where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'philPass') === 0) {	
					$sql_r="select plan_code from plan_code_hana_phil where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'malaPass') === 0) {	
					$sql_r="select plan_code from plan_code_hana_mala where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'thaiPass5') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai_5 where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}
				if(strcmp($thai_chk,'thaiPass1') === 0) {
					$sql_r="select plan_code from plan_code_hana_thai_1 where trip_type='".$tripType."' and cal_type='2' and plan_type like '%".$plan_type."%'";
				}

                $result_r=mysql_query($sql_r);
                $row_r=mysql_fetch_array($result_r);
                
                $plan_code[$i]=$row_r['plan_code'];
            }
        }
        
        $add_query="";
        
        if ($plan_code[$i]!="") {
            $add_query=" and plan_code='".$plan_code[$i]."'";
        }
        
			 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
			$select_term="select plan_code, price from plan_code_price_hana where trip_type='".$tripType."' and company_type=1 and member_no='".$site_config_member_no."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}
		
		if(strcmp($thai_chk,'thaiPass') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_thai where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}

		if(strcmp($thai_chk,'kamboPass') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_kam where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}

		if(strcmp($thai_chk,'indonPass') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_indonesia where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}
		if(strcmp($thai_chk,'philPass') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_phil where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}
		if(strcmp($thai_chk,'malaPass') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_mala where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}

		if(strcmp($thai_chk,'thaiPass5') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_thai_5 where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}

		if(strcmp($thai_chk,'thaiPass1') === 0) {
			$select_term="select plan_code, price from plan_code_price_hana_thai_1 where trip_type='".$tripType."' and plan_type like '%".$plan_type."%' and term_day >= '".$term_day."' and sex='".$sex."' and age='".$cal_age."' ".$add_query." order by term_day asc limit 1";
		}

        $result_term=mysql_query($select_term);
        $row_term=mysql_fetch_array($result_term);
        
			 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
			$sql_title="select * from plan_code_hana where plan_code='".$row_term['plan_code']."' and company_type=1 and member_no='".$site_config_member_no."'";
		 }

		if(strcmp($thai_chk,'thaiPass') === 0) {
			$sql_title="select * from plan_code_hana_thai where plan_code='".$row_term['plan_code']."' ";
		}

		if(strcmp($thai_chk,'kamboPass') === 0) {
			$sql_title="select * from plan_code_hana_kam where plan_code='".$row_term['plan_code']."' ";		
		}	

		if(strcmp($thai_chk,'indonPass') === 0) {
			$sql_title="select * from plan_code_hana_indonesia where plan_code='".$row_term['plan_code']."' ";		
		}	
		if(strcmp($thai_chk,'philPass') === 0) {
			$sql_title="select * from plan_code_hana_phil where plan_code='".$row_term['plan_code']."' ";		
		}	
		if(strcmp($thai_chk,'malaPass') === 0) {
			$sql_title="select * from plan_code_hana_mala where plan_code='".$row_term['plan_code']."' ";		
		}	

		if(strcmp($thai_chk,'thaiPass5') === 0) {
			$sql_title="select * from plan_code_hana_thai_5 where plan_code='".$row_term['plan_code']."' ";
		}

		if(strcmp($thai_chk,'thaiPass1') === 0) {
			$sql_title="select * from plan_code_hana_thai_1 where plan_code='".$row_term['plan_code']."' ";
		}

        $result_title=mysql_query($sql_title);
        $row_title=mysql_fetch_array($result_title);
        
        $msg[$i]['plan_title']=$row_title['plan_title'];
        $msg[$i]['plan_code']=$row_term['plan_code'];
        $msg[$i]['price']=number_format($row_term['price']);
        $total_price=$total_price+$row_term['price'];
    }
}

$json_code = array('result'=>'true','msg'=>$msg,'total_price'=>number_format($total_price),'total_price_val'=>$total_price);
echo json_encode($json_code);
exit;
?>