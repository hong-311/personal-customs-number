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
           if ($categorycode == 'C' || $categorycode == 'C2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub3.php?categorycode=C">인증번호, 부호 분실 시</a>';
            echo '<a href="./sub3.php?categorycode=C1">정지 또는 재발급은?</a>';
            echo '<a href="./sub3.php?categorycode=C2">해외직구, 통관 진행사항</a>';
            echo '<a href="./sub3.php?categorycode=C3-1">개인정보 변경될 시</a>';
            echo '<a href="./sub3.php?categorycode=C4-1">부호 항목 수정 방법은?</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, bold, content FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                if ($categorycode == 'C2') {
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
            if ($categorycode == 'C') {
                echo '<div class="btn_wrap1">';
                echo '<a class="next" href="./sub3.php?categorycode=C1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">정지 또는 재발급</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            } elseif ($categorycode == 'C2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">정지 또는 재발급</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">이름변경</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }  elseif ($categorycode == 'C1') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub3.php?categorycode=C">인증번호, 부호 분실 시</a>';
            echo '<a href="./sub3.php?categorycode=C1">정지 또는 재발급은?</a>';
            echo '<a href="./sub3.php?categorycode=C2">해외직구, 통관 진행사항</a>';
            echo '<a href="./sub3.php?categorycode=C3-1">개인정보 변경될 시</a>';
            echo '<a href="./sub3.php?categorycode=C4-1">부호 항목 수정 방법은?</a>';
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
            if ($categorycode == 'C1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">인증번호, 부호 분실 시</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">해외직구, 통관 진행사항</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'C3-1' || $categorycode == 'C3-2') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub3.php?categorycode=C">인증번호, 부호 분실 시</a>';
            echo '<a href="./sub3.php?categorycode=C1">정지 또는 재발급은?</a>';
            echo '<a href="./sub3.php?categorycode=C2">해외직구, 통관 진행사항</a>';
            echo '<a href="./sub3.php?categorycode=C3-1">개인정보 변경될 시</a>';
            echo '<a href="./sub3.php?categorycode=C4-1">부호 항목 수정 방법은?</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, content, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub3.php?categorycode=C3-1">이름변경</a>';
                echo '<a href="./sub3.php?categorycode=C3-2">휴대폰 번호변경</a>';
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
          if ($categorycode == 'C3-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">해외직구, 통관 진행사항</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">휴대폰 번호변경</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'C3-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C3-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">이름변경</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">모바일 APP</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        }else  if ($categorycode == 'C4-1' || $categorycode == 'C4-2' || $categorycode == 'C4-3') {
            echo '<div class="flex">';
            echo '<div class="btn_group">';
            echo '<a href="./sub3.php?categorycode=C">인증번호, 부호 분실 시</a>';
            echo '<a href="./sub3.php?categorycode=C1">정지 또는 재발급은?</a>';
            echo '<a href="./sub3.php?categorycode=C2">해외직구, 통관 진행사항</a>';
            echo '<a href="./sub3.php?categorycode=C3-1">개인정보 변경될 시</a>';
            echo '<a href="./sub3.php?categorycode=C4-1">부호 항목 수정 방법은?</a>';
            echo '</div>';
        
            $sql2 = "SELECT sub_title, box_con, box_title FROM content WHERE categorycode = ?";
            $result2 = query($sql2, [$categorycode])->fetchAll();
        
            if (!empty($result2)) {
                echo '<div class="content1">';
                echo '<div class="btn_group2">';
                echo '<a href="./sub3.php?categorycode=C4-1">모바일 APP</a>';
                echo '<a href="./sub3.php?categorycode=C4-2">모바일 WEB</a>';
                echo '<a href="./sub3.php?categorycode=C4-3">PC 이용</a>';
                echo '</div>';
                echo '<pre class="sub_title">' . htmlspecialchars($result2[0]['sub_title']) . '</pre>';
                echo '<pre class="top_p">∎ 개인통관고유부호 항목(주소, 전화번호 등) 수정 방법은 다음과 같습니다.</pre>';
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
          if ($categorycode == 'C4-1') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C3-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">휴대폰 번호변경</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">모바일 WEB</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }else if ($categorycode == 'C4-2') {
                echo '<div class="btn_wrap2">';
                echo '<a class="back5" href="./sub3.php?categorycode=C4-1">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">모바일 APP</span>';
                echo '</div>';
                echo '</a>';
                echo '<a class="next" href="./sub3.php?categorycode=C4-3">';
                echo '<div class="btn_left">';
                echo '<span class="s1">다음글</span>';
                echo '<span class="s2">PC 이용</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }elseif ($categorycode == 'C4-3') {
                echo '<div class="btn_wrap1">';
                echo '<a class="back5" href="./sub3.php?categorycode=C4-2">';
                echo '<div class="btn_left">';
                echo '<span class="s1">이전글</span>';
                echo '<span class="s2">모바일 WEB</span>';
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
