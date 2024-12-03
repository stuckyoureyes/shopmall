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
        array("image" => "/shopmall/image/image6.png", "title" => "Best Item 6", "description" => "Limited stock available."),
        array("image" => "/shopmall/image/image15.png", "title" => "New Arrival 4", "description" => "Perfect for all seasons."),
        array("image" => "/shopmall/image/image16.png", "title" => "New Arrival 5", "description" => "Comfort meets elegance.")
    ),
    "new" => array(
        array("image" => "/shopmall/image/image12.png", "title" => "New Arrival 1", "description" => "Check out our latest collection."),
        array("image" => "/shopmall/image/image13.png", "title" => "New Arrival 2", "description" => "Fresh and trendy new item."),
        array("image" => "/shopmall/image/image14.png", "title" => "New Arrival 3", "description" => "Style that speaks to you."),
        array("image" => "/shopmall/image/image15.png", "title" => "New Arrival 4", "description" => "Perfect for all seasons."),
        array("image" => "/shopmall/image/image16.png", "title" => "New Arrival 5", "description" => "Comfort meets elegance.")
    )
);

function renderSlider($sliderData) {
    echo "<div class='slider-section'>";
    echo "<div class='image-slider'>";
    echo "<div class='image-track'>";

    // 원본 이미지 출력
    foreach ($sliderData as $item) {
        echo "<div class='image-card'>";
        echo "<img src='{$item['image']}' alt='{$item['title']}'>";
        echo "</div>";
    }


 
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>

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
        <a href="main.php">HOME</a>
        <a href="../shop/shop.php">SHOP</a>
        <div class="community-menu">
            <a href="#">COMMUNITY</a>
            <ul class="category">
                <li><a href="/board/free/list.html?board_no=1">NEWS&amp;EVENT</a></li>
                <li><a href="/product/list_portfolio.html?cate_no=45">COLLECTION</a></li>
                <li><a href="/board/product/list.html?board_no=4">REVIEW</a></li>
                <li><a href="/board/product/list.html?board_no=6">Q&amp;A</a></li>
            </ul>
        </div>
        <a href="#">CONTACT</a>
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
            <iframe
                src="https://www.youtube.com/embed/<?php echo $videoID; ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo $videoID; ?>&controls=0&showinfo=0&modestbranding=1"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen
                title="YouTube video"
            ></iframe>
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
            <p>우리의 여행은 가장 찬란하고 아름다운 시절, 그 풋풋한 감정에서 시작되었습니다...</p>
        </div>
    </section>

    <?php foreach ($sliders as $key => $sliderData): ?>
    <div class="<?php echo $key; ?>-item">
        <h2><?php echo ($key === 'best') ? 'Top Seller' : 'New Arrivals!'; ?></h2>
    </div>
    <?php renderSlider($sliderData); ?>
<?php endforeach; ?>
<br>
<br>
<br>
<br>
<br>

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

    <script>
    document.querySelectorAll('.image-slider').forEach(slider => {
    const track = slider.querySelector('.image-track');
    const cards = slider.querySelectorAll('.image-card');
    const cardWidth = cards[0].offsetWidth; // 카드 너비 계산
    let index = 3; // 복제된 요소를 고려한 초기 위치

    // 복제본 생성 (첫 3개, 마지막 3개 복제)
    for (let i = 0; i < 3; i++) {
        const firstClone = cards[i].cloneNode(true); // 첫 번째 세 개 복제
        const lastClone = cards[cards.length - 1 - i].cloneNode(true); // 마지막 세 개 복제
        track.appendChild(firstClone); // 트랙 끝에 추가
        track.insertBefore(lastClone, track.firstChild); // 트랙 시작에 추가
    }


    // 초기 위치 설정
    track.style.transform = `translateX(${-cardWidth * index}px)`;

    // 슬라이드 함수
    const slide = () => {
        index++;
        track.style.transition = "transform 0.5s ease-in-out";
        track.style.transform = `translateX(${-cardWidth * index}px)`;

        // 트랜지션 끝난 후 순환 처리
        track.addEventListener("transitionend", () => {
            if (index === cards.length + 1) {
                // 마지막 복제본에서 실제 첫 번째 이미지로 이동
                track.style.transition = "none";
                index = 1;
                track.style.transform = `translateX(${-cardWidth * index}px)`;
            } else if (index === 0) {
                // 첫 번째 복제본에서 실제 마지막 이미지로 이동
                track.style.transition = "none";
                index = cards.length;
                track.style.transform = `translateX(${-cardWidth * index}px)`;
            }
        });
    };

    // 자동 슬라이드
    let interval = setInterval(slide, 2000);

    // 마우스 오버 시 슬라이드 멈춤
    slider.addEventListener("mouseenter", () => clearInterval(interval));
    slider.addEventListener("mouseleave", () => {
        interval = setInterval(slide, 2000);
    });
});

    </script>
</body>
</html>
