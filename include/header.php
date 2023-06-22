<div id="header">
    <div class="in_header">
<?
//if (defined('_TOURSAFE_SUBSITE_NEW_BI')) {
?>
        <!-- 추가 로고 작업할 영역  main.php?logo=1 로 url 보기 -->


<?
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/img/logo.png") && _TOURSAFE_MEMBER_NO != '106') {
?>            
		<h1 class="logo_new"><a href="/main/main.php">
<?}else{?>
		<h1 class="logo_new"><a href="/index_longterm.php">
<?}?>
<?
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/img/logo.png") && _TOURSAFE_MEMBER_NO != '106') {
?>            
        <img src="/img/logo.png?v=<?=time()?>" alt="logo" class="first">
<?
    }
?>
        <img src="/tscommon/img/common/toursafe-logo.png" alt="투어세이프 여행자보험"></a>
<?
/*
} else {
?>
        <h1><a href="/main/main.php"><img src="/img/logo.png?v=13457" alt="투어세이프 여행자보험"></a>
<?    
}
*/
?>
            <?=$arrToursafeCommonAddHtml['header_right']?>
        </h1>
        <h2 class="skip">주요 서비스 메뉴</h2>
        <div id="gnbW" class="w_gnb">
            <? include ($common_root_dir."/include/gnb.php"); ?>
        </div>
    </div>
    <div class="m_gnbW">
        <div class="m_gnb_on bt_all">
            <div class="menu_btn">
                <div class="line-top"></div>
                <div class="line-middle"></div>
                <div class="line-bottom"></div>
            </div>
        </div>
    </div>
    <div id="gnb_bar">
    </div>
</div>

<!-- m gnb -->

<div id="slide_menu_wrap" class="slide_menu_wrap ">
    <div class="slide_menu_inner">
        <? include ($common_root_dir."/include/gnb.php"); ?>
    </div>
    <div class="all_close">
        <div class="menu_btn is-open">
            <div class="line-top"></div>
            <div class="line-middle"></div>
            <div class="line-bottom"></div>
        </div>
    </div>
</div>

<!-- //m gnb -->

<div id="black"></div>