<div class="gnb">
    <ul>
<? if ($tripType=="1") { ?>
        <li class="gnb01"><a href="/tscommon/trip/01.php"><span>국내여행자 보험가입</span></a></li>
        <li class="gnb03"><a href="/tscommon/check/01.php"><span>가입내역조회</span></a></li>
<? } elseif ($tripType=="2") { ?>
		<li class="gnb01"><a href="/tscommon/trip/01.php"><span>해외여행자 보험가입</span></a></li>
		<li class="gnb03"><a href="/tscommon/check/01.php"><span>가입내역조회</span></a></li>
<? } elseif ($tripType=="3") { ?>
        <li class="gnb02"><a href="/tscommon/study_abroad/01.php"><span>유학(장기체류)보험 가입</span></a></li>
<? } else { ?>
		<li class="gnb01"><a href="javascript:void(0);"><span>여행자 보험가입</span></a>
            <ul class="sub_menu">
                <li class="lnb1"><a href="/tscommon/common/typecheck.php?type=2">해외여행자 보험가입</a></li>
                <li class="lnb2"><a href="/tscommon/common/typecheck.php?type=1">국내여행자 보험가입</a></li>
				<li class="lnb3"><a href="/tscommon/common/typecheck.php?type=3">유학(장기체류)보험 가입</a></li>
            </ul>
        </li>
        <li class="gnb03"><a href="/tscommon/check/01.php"><span>가입내역조회</span></a></li>
<? } ?>
    </ul>
</div>
