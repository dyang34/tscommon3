
<link rel="stylesheet" type="text/css" href="/tscommon/css/sub.ver1.css?v=<?=time()?>">

<!-- /******************************** 가입내역 조회 -->
<? if($menuNo[0]==2): ?>
<div class="sub-visual check">
    <div class="inner">
        <h2>가입내역 조회</h2>
    </div>
</div>

<!-- /******************************** 라이프 -->
<? elseif($menuNo[0]==3): ?>
<div class="sub-visual life">
    <div class="inner">
        <h2>라이프</h2>
        <p>알아두면 유용한 생활 정보</p>
    </div>
</div>

<!-- /******************************** FAQ -->
<? elseif($menuNo[0]==4): ?>
<div class="sub-visual service">
    <div class="inner">
        <h2>FAQ</h2>
    </div>
</div>

<!-- /******************************** 약관 -->
<? elseif($menuNo[0]==5 && $menuNo[1]==1): ?>
<div class="sub-visual terms">
    <div class="inner">
        <h2>이용약관</h2>
    </div>
</div>

<? elseif($menuNo[0]==5 && $menuNo[1]==2): ?>
<div class="sub-visual terms">
    <div class="inner">
        <h2>개인정보수집 및 이용</h2>
    </div>
</div>
<? endif ?>