<?php
include './db.php'; 
error_reporting(E_ALL);
ini_set("display_errors", 1);

$categorycode = $_GET['categorycode']; 
$sql = "SELECT DISTINCT title FROM content WHERE categorycode = ?"; 
$params = [$categorycode];
$result = query($sql, $params)->fetch();
$category = $result['title'];

// 변수 초기화
$title = "";

if (!empty($result)) {
    $title = $result['title'];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include "./front_header.php"; ?>
    <link rel="stylesheet" href="./css/sub.css">
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        // == 마스킹코드 ==
        window.addEventListener('load', function() {
            document.getElementById('loading-mask').remove();
        });
    </script>
</head>
<body>
    <div id="loading-mask" style="position: fixed; z-index: 999; left: 0; right: 0; top: 0; bottom: 0;"></div>
    <div id="wrap">
        <?php include "./header.php"; ?>
        <div class="section_<?php echo $categorycode; ?>">
            <?php
           if ($categorycode == 'E' || $categorycode == 'E2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub5.php?categorycode=E">물품 반품 후 환급</a>';
            echo '<a href="./sub5.php?categorycode=E1">국가별 해외직구</a>';
            echo '<a href="./sub5.php?categorycode=E2">해외 쇼핑몰 추천</a>';
            echo '<a href="./sub5.php?categorycode=E3-1">사기사례</a>';
            echo '<a href="./sub5.php?categorycode=E4-1">합배송 서비스</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, bold, content FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                if ($categorycode == 'E2') {
                    echo '<img src="./img/sub-img.png"  class="custom_image">';
                }
        
                echo '<h2 class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</h2>';
                echo '<div class="box">';
                foreach ($result2 as $val) {
                    echo '<pre class="bold">' . htmlspecialchars($val['bold']) . '</pre>';
                    echo '<pre class="con">' . htmlspecialchars($val['content']) . '</pre>';
                }
                echo '</div>'; // box
                echo '<div class="top_button_wrap">';
                echo '<a href="#" class="top_button"><img src="./img/deco-2.png"></a>';
                echo '</div>';
                echo '</div>'; // content1
            }
        
            echo '</div>'; // flex
        
            // 네비게이션 버튼 처리
            if ($categorycode == 'E') {
                echo '<div class="btn_wrap1">';
                echo '<a class="next" href="./sub5.php?categorycode=E1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">국가별 해외직구</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'E2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">국가별 해외직구</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">사례1~3</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }  elseif ($categorycode == 'E1') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub5.php?categorycode=E">물품 반품 후 환급</a>';
            echo '<a href="./sub5.php?categorycode=E1">국가별 해외직구</a>';
            echo '<a href="./sub5.php?categorycode=E2">해외 쇼핑몰 추천</a>';
            echo '<a href="./sub5.php?categorycode=E3-1">사기사례</a>';
            echo '<a href="./sub5.php?categorycode=E4-1">합배송 서비스</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, box_con, box_title, content FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                if ($categorycode == 'A2') {
                    echo '<img src="./img/sub-img.png"  class="custom_image">';
                }
        
                echo '<h2 class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</h2>';
                
                foreach ($result2 as $val) {
                    echo '<div class="box">';
                    if (!empty($val['content'])) {
                        echo '<pre class="con">' . htmlspecialchars($val['content']) . '</pre>';
                    }
                    
                    if (!empty($val['box_title']) && !empty($val['box_con'])) {
                        echo '<pre class="box_title">' . htmlspecialchars($val['box_title']) . '</pre>';
                        echo '<pre class="box_con">' . htmlspecialchars($val['box_con']) . '</pre>';
                    }
                    
                    echo '</div>'; // box
                }
                echo '<div class="top_button_wrap">';
                echo '<a href="#" class="top_button"><img src="./img/deco-2.png"></a>';
                echo '</div>';
                echo '</div>'; // content1
            }
        
            echo '</div>'; // flex
        
            // 네비게이션 버튼 처리
            if ($categorycode == 'E1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">물품 반품 후 환급</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">해외 쇼핑몰 추천</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'E3-1' || $categorycode == 'E3-2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub5.php?categorycode=E">물품 반품 후 환급</a>';
            echo '<a href="./sub5.php?categorycode=E1">국가별 해외직구</a>';
            echo '<a href="./sub5.php?categorycode=E2">해외 쇼핑몰 추천</a>';
            echo '<a href="./sub5.php?categorycode=E3-1">사기사례</a>';
            echo '<a href="./sub5.php?categorycode=E4-1">합배송 서비스</a>';
            echo '</div>';

            $sql2 = "SELECT sub_title, content, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub5.php?categorycode=E3-1">사례1~3</a>';
                echo '<a href="./sub5.php?categorycode=E3-2">사례4~6</a>';
                echo '</div>';
                echo '<div class="box">';
                foreach ($result2 as $val) {
                    echo '<pre class="box_title">' . htmlspecialchars($val['box_title']) . '</pre>';
                    echo '<pre class="con">' . htmlspecialchars($val['content']) . '</pre>';
                }
                echo '</div>'; // box
                echo '<div class="top_button_wrap">';
                echo '<a href="#" class="top_button"><img src="./img/deco-2.png"></a>';
                echo '</div>';
                echo '</div>'; // content1
            }
        
            echo '</div>'; // flex
        
            // 네비게이션 버튼 처리
          if ($categorycode == 'E3-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">해외 쇼핑몰 추천</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">사례4~6</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'E3-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">사례1~3</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">장점</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'E4-1' || $categorycode == 'E4-2' || $categorycode == 'E4-3') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub5.php?categorycode=E">물품 반품 후 환급</a>';
            echo '<a href="./sub5.php?categorycode=E1">국가별 해외직구</a>';
            echo '<a href="./sub5.php?categorycode=E2">해외 쇼핑몰 추천</a>';
            echo '<a href="./sub5.php?categorycode=E3-1">사기사례</a>';
            echo '<a href="./sub5.php?categorycode=E4-1">합배송 서비스</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, box_con, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub5.php?categorycode=E4-1">장점</a>';
                echo '<a href="./sub5.php?categorycode=E4-2">이용방법</a>';
                echo '<a href="./sub5.php?categorycode=E4-3">주의사항</a>';
                echo '</div>';
                echo '<pre class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</pre>';
                echo '<pre class="top_p">여러 해외 쇼핑몰에서 구매한 상품을 하나의 박스로 묶어 한 번에 받을 수 있도록 도와주는 서비스입니다. 이를 이용하면 배송비를 절약할 수 있고, 통관 절차가 간소화 할 수 있습니다.</pre>';
                foreach ($result2 as $val) {
                    echo '<div class="box">';
                    echo '<pre class="box_title">' . htmlspecialchars($val['box_title']) . '</pre>';
                    echo '<pre class="box_con">' . htmlspecialchars($val['box_con']) . '</pre>';
                    echo '</div>'; // box
                }
                echo '<div class="top_button_wrap">';
                echo '<a href="#" class="top_button"><img src="./img/deco-2.png"></a>';
                echo '</div>';
                echo '</div>'; // content1
            }
        
            echo '</div>'; // flex
        
            // 네비게이션 버튼 처리
          if ($categorycode == 'E4-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">사례4~6</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">이용방법</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }else if ($categorycode == 'E4-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub5.php?categorycode=E4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">장점</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub5.php?categorycode=E4-3">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">주의사항</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'E4-3') {
                echo '<div class="btn_wrap1">';
                echo '<a class="back5" href="./sub5.php?categorycode=E4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">이용방법</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }
            ?>
        </div>
    </div>
</body>
<script>
    // 텍스트 인식
    var preTags = document.getElementsByTagName("pre");
    for (var i = 0; i < preTags.length; i++) {
        var preTag = preTags[i];
        var processedText = preTag.innerHTML;
        processedText = processedText.replace(/\[\[\[(.*?)\]\]\]/gs, '<span class="point1">$1</span>');
        processedText = processedText.replace(/\[\[(.*?)\]\]/gs, '<span class="point2">$1</span>');
        processedText = processedText.replace(/\[(.*?)\]/gs, '<span class="point3">$1</span>');
        preTag.innerHTML = processedText;
    }

    var preTags = document.getElementsByTagName("p");
    for (var i = 0; i < preTags.length; i++) {
        var preTag = preTags[i];
        var processedText = preTag.innerHTML;
        processedText = processedText.replace(/\[\[\[(.*?)\]\]\]/gs, '<span class="point1">$1</span>');
        processedText = processedText.replace(/\[\[(.*?)\]\]/gs, '<span class="point2">$1</span>');
        processedText = processedText.replace(/\[(.*?)\]/gs, '<span class="point3">$1</span>');
        preTag.innerHTML = processedText;
    }
</script>
<script>
    // '탑으로' 버튼 클릭 시 페이지 상단으로 이동하는 스크립트
    document.querySelector('.top_button').addEventListener('click', function(e) {
        e.preventDefault(); // 기본 동작 막기
        window.scrollTo({top: 0, behavior: 'smooth'}); // 스크롤 상단 이동
    });
</script>

</html>
