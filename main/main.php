<?php
// 유튜브 비디오 ID
$videoID = "doFK7Eanm3I";

$sliders = array(
    "best" => array(
        array("image" => "/shopmall/image/image1.png", "title" => "Best Item 1", "description" => "This is the best-selling item."),
        array("image" => "/shopmall/image/image2.png", "title" => "Best Item 2", "description" => "Another popular choice among customers."),
        array("image" => "/shopmall/image/image3.png", "title" => "Best Item 3", "description" => "A must-have for this season."),
        array("image" => "/shopmall/image/image4.png", "title" => "Best Item 4", "description" => "Top-rated product."),
        array("image" => "/shopmall/image/image5.png", "title" => "Best Item 5", "description" => "Limited stock available."),
        array("image" => "/shopmall/image/image6.png", "title" => "Best Item 6", "description" => "Limited stock available.")
    ),
    // "new" 키 추가
    "new" => array(
        array("image" => "/shopmall/image/image12.png", "title" => "New Arrival 1", "description" => "Check out our latest collection."),
        array("image" => "/shopmall/image/image13.png", "title" => "New Arrival 2", "description" => "Fresh and trendy new item."),
        array("image" => "/shopmall/image/image14.png", "title" => "New Arrival 3", "description" => "Style that speaks to you."),
        array("image" => "/shopmall/image/image15.png", "title" => "New Arrival 4", "description" => "Perfect for all seasons."),
        array("image" => "/shopmall/image/image16.png", "title" => "New Arrival 5", "description" => "Comfort meets elegance.")
    )
);
    
function renderSlider($sliderData)
{
    echo "<div class='slider-section'>";
    echo "<div class='image-slider'>";
    echo "<div class='image-track'>";
    foreach ($sliderData as $item) {
        echo "<div class='image-card'>";
        echo "<img src='{$item['image']}' alt='{$item['title']}'>";
        echo "<div class='image-description'>";
        echo "<h3>{$item['title']}</h3>";
        echo "<p>{$item['description']}</p>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>

<script>
   document.querySelectorAll('.image-slider').forEach(slider => {
    let isDown = false;
    let startX;
    let scrollLeft;

    const track = slider.querySelector('.image-track');

    // 마우스로 슬라이드 이동
    track.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    track.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 1.5;
        slider.scrollLeft = scrollLeft - walk;
    });

    track.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    track.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    // 3초 간격으로 자동 슬라이드
    let scrollInterval = setInterval(() => {
        const maxScrollLeft = track.scrollWidth - track.clientWidth; // 최대 스크롤 값
        if (slider.scrollLeft >= maxScrollLeft - 1) {
            slider.scrollLeft = 0; // 맨 앞으로 돌아감
        } else {
            slider.scrollLeft += slider.clientWidth; // 한 화면씩 이동
        }
    }, 3000);

    // 마우스 오버 시 자동 슬라이드 중지, 떠나면 재개
    slider.addEventListener('mouseover', () => clearInterval(scrollInterval));
    slider.addEventListener('mouseleave', () => {
        scrollInterval = setInterval(() => {
            if (slider.scrollLeft >= maxScrollLeft - 1) {
                slider.scrollLeft = 0;
            } else {
                slider.scrollLeft += slider.clientWidth;
            }
        }, 3000);
    });
});

</script>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hip Shopping Experience</title>
    <link rel="stylesheet" href="main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- 헤더 -->
    <header class="header">
        <div class="logo"><a href="main.php">KIMGOON</a></div>
        <nav class="nav">
            <a href="main.php">Home</a>
            <a href="../shop/shop.php">Shop</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
        <div class="sub-nav">
            <div class="icon">
                <a href="#"><i class="fa-solid fa-user"></i></a>
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="search-container">
                <form class="search-form" action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Search products..." class="search-input">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </form>
            </div>
        </div>
    </header>

    <!-- 유튜브 비디오 배경 -->
    <section class="video-banner">
        <div class="youtube-video">
            <video class="background-video" autoplay muted loop playsinline>
                <source src="gdragon.mp4" type="video/mp4">
                <!-- 브라우저가 동영상을 지원하지 않는 경우 대체 텍스트 -->
                동영상이 재생되지 않을 경우 브라우저를 업데이트하거나 지원되는 브라우저를 사용해주세요.
            </video>
            <div class="overlay">
                <h2>24 FW CAMPAIGN</h2>
                <p>빛으로 물든 시간, 마음이 닿은 자리.</p>
                <a href="#store" class="btn">스토어 바로가기</a>
            </div>
        </div>
    </section>

    <!-- 소개 섹션 -->
    <section class="intro-section">
        <div class="intro-content">
            <p style="font-weight: bolder">WINTER 2024 CAMPAIGN</p>
            <p>우리의 여행은 가장 찬란하고 아름다운 시절, 그 풋풋한 감정에서 시작되었습니다. 잠시 잊고 있었지만, 그때의 우리에게는 모든 순간이 소중했고, 인생에서 가장 빛났던 순간들이었습니다. 여행지에 내려앉았던 따스한 빛 그리고 서로의 마음이 닿았던 그 자리까지, 당신의 지금이 우리의 그때와 같이 아름답기를 바랍니다.</p>
        </div>
    </section>

    <div class="best-item">
        <h2>BEST</h2>
    </div>

    <?php
    renderSlider($sliders["best"]);
    ?>

    <div class="new-item">
        <h2>NEW</h2>
    </div>

    <?php
    if (isset($sliders["new"])) {
        renderSlider($sliders["new"]);
    } else {
        echo "<p>No new items available.</p>";
    }
    ?>



    <!-- 푸터 -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <ul>
                    <li><a href="#">이용약관</a></li>
                    <li><a href="#">이용안내</a></li>
                    <li><a href="#">개인정보처리방침</a></li>
                </ul>
                <button class="chat-btn">채팅상담</button>
            </div>
            <div class="footer-center">
                <div class="customer-service">
                    <h4>CUSTOMER SERVICE</h4>
                    <p>MON-FRI 10:00 - 17:00</p>
                    <p>LUNCH 12:00 - 13:00</p>
                    <p>SAT.SUN.HOLIDAY OFF</p>
                </div>
                <div class="footer-logo">
                    <h1>SH</h1>
                </div>
            </div>
            <div class="footer-right">
                <ul>
                    <li><a href="#">앱다운</a></li>
                    <li><a href="#">인스타그램: tpgus1k</a></li>
                    <li><a href="#">자주 묻는 질문</a></li>
                </ul>
                <div class="bank-info">
                    <h4>BANK INFO</h4>
                    <p>IBK 062-158803-01-016</p>
                    <p>예금주 : 김세현</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>COMPANY INFO +</p>
            <button class="inquiry-btn">
                <span>SH 문의하기</span>
            </button>
        </div>
    </footer>

</body>

</html>