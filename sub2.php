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
           if ($categorycode == 'B' || $categorycode == 'B2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub2.php?categorycode=B">해외이사화물</a>';
            echo '<a href="./sub2.php?categorycode=B1">간이통관</a>';
            echo '<a href="./sub2.php?categorycode=B2">관세와 부가가치세 계산법</a>';
            echo '<a href="./sub2.php?categorycode=B3-1">자동차 통관</a>';
            echo '<a href="./sub2.php?categorycode=B4-1">통관예약 및 자동차 등록절차</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, bold, link, content FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                if ($categorycode == 'B2') {
                    echo '<img src="./img/sub-img.png"  class="custom_image">';
                }
        
                echo '<h2 class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</h2>';
                echo '<div class="box">';
                foreach ($result2 as $index => $val) {
                    echo '<pre class="bold">' . htmlspecialchars($val['bold']) . '</pre>';
                    echo '<pre class="con">' . htmlspecialchars($val['content']) . '</pre>';
                    
                    if (!empty($val['link'])) {
                        echo '<div class="link_wrap">';
                        
                        if ($index === 0) { // 첫 번째 링크
                            echo '<span>허가이사 종합정보</span>';
                        } elseif ($index === 2) { // 두 번째 링크
                            echo '<span>관세 예상금액 구하러가기</span>';
                        }
                
                        echo '<pre class="link"><a href="' . htmlspecialchars($val['link']) . '" target="_blank">바로가기</a></pre>';
                        echo '</div>';
                    }
                }
                
                echo '</div>'; // box
                echo '<div class="top_button_wrap">';
                echo '<a href="#" class="top_button"><img src="./img/deco-2.png"></a>';
                echo '</div>';
                echo '</div>'; // content1
            }
        
            echo '</div>'; // flex
        
            // 네비게이션 버튼 처리
            if ($categorycode == 'B') {
                echo '<div class="btn_wrap1">';
                echo '<a class="next" href="./sub2.php?categorycode=B1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">간이통관 절차</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            } elseif ($categorycode == 'B2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">간이통관 절차</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">자동차통관 절차</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }  elseif ($categorycode == 'B1') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub2.php?categorycode=B">해외이사화물</a>';
            echo '<a href="./sub2.php?categorycode=B1">간이통관</a>';
            echo '<a href="./sub2.php?categorycode=B2">관세와 부가가치세 계산법</a>';
            echo '<a href="./sub2.php?categorycode=B3-1">자동차 통관</a>';
            echo '<a href="./sub2.php?categorycode=B4-1">통관예약 및 자동차 등록절차</a>';
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
            if ($categorycode == 'B1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">해외이사화물</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">관세/부가가치세 계산법</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'B3-1' || $categorycode == 'B3-2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub2.php?categorycode=B">해외이사화물</a>';
            echo '<a href="./sub2.php?categorycode=B1">간이통관</a>';
            echo '<a href="./sub2.php?categorycode=B2">관세와 부가가치세 계산법</a>';
            echo '<a href="./sub2.php?categorycode=B3-1">자동차 통관</a>';
            echo '<a href="./sub2.php?categorycode=B4-1">통관예약 및 자동차 등록절차</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, content, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub2.php?categorycode=B3-1">절차</a>';
                echo '<a href="./sub2.php?categorycode=B3-2">더 알아보기</a>';
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
          if ($categorycode == 'B3-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">관세/부가가치세 계산법</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">자동차통관 더 알아보기</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'B3-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">자동차통관 절차</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">통관예약 사전준비</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'B4-1' || $categorycode == 'B4-2' || $categorycode == 'B4-3') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub2.php?categorycode=B">해외이사화물</a>';
            echo '<a href="./sub2.php?categorycode=B1">간이통관</a>';
            echo '<a href="./sub2.php?categorycode=B2">관세와 부가가치세 계산법</a>';
            echo '<a href="./sub2.php?categorycode=B3-1">자동차 통관</a>';
            echo '<a href="./sub2.php?categorycode=B4-1">통관예약 및 자동차 등록절차</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, box_con, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub2.php?categorycode=B4-1">통관예약 사전준비</a>';
                echo '<a href="./sub2.php?categorycode=B4-2">이용절차</a>';
                echo '<a href="./sub2.php?categorycode=B4-3">자동차 등록절차</a>';
                echo '</div>';
                echo '<pre class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</pre>';
                echo '<pre class="top_p">이사화물 통관예약은 당일 통관희망자를 파악하여 컨테이너 작업을 완료함으로써 보다 신속한 통관을 위한 절차입니다. 예약을 하시지 않으면 통관에 장시간이 소요될 수 있습니다.
                    통관절차가 완료된 물품을 계속 창고에 놓아두면 파손이나 분실의 위험이 있으며 보관료를 더 물어야 하기 때문에 당일 출고하는 것이 좋습니다.
                    </pre>';
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
          if ($categorycode == 'B4-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">자동차통관 더 알아보기</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">이용절차</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }else if ($categorycode == 'B4-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub2.php?categorycode=B4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">통관예약 사전준비</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub2.php?categorycode=B4-3">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">자동차 등록 절차</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'B4-3') {
                echo '<div class="btn_wrap1">';
                echo '<a class="back5" href="./sub2.php?categorycode=B4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">이용절차</span>';
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
