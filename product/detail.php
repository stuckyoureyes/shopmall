<?php
// 상품 리스트 배열
$products = array(
    1 => array(
        "name" => "크로스 라인 후드 구스 다운 - 블랙",
        "price" => "463,000원",
        "sale" => "439,850원",
        "image" => "/shopmall/image/bag1.png",
        "description" => "가로와 세로 크로스로 스티치 라인이 나누어진 것이 특징인 후드 구스 다운 자켓. 짧은 기장으로 제작되어 다양한 아웃핏과 레이어링에 용이한 제품입니다."
    ),
    2 => array(
        "name" => "오피서 백팩 - 블랙",
        "price" => "252,000원",
        "sale" => "239,400원",
        "image" => "/shopmall/image/bag2.png",
        "description" => "고급스러운 디자인과 넉넉한 수납공간을 자랑하는 블랙 오피서 백팩입니다."
    ),
    3 => array(
        "name" => "프로치다 백 - 블랙",
        "price" => "357,000원",
        "sale" => "339,150원",
        "image" => "/shopmall/image/bag3.png",
        "description" => "부드러운 소재와 견고한 제작으로 완성된 블랙 프로치다 백입니다."
    ),
    4 => array(
        "name" => "프로치다 백 - 누버크 브라운",
        "price" => "367,000원",
        "sale" => "348,650원",
        "image" => "/shopmall/image/bag4.png",
        "description" => "따뜻한 누버크 브라운 컬러가 돋보이는 클래식한 프로치다 백입니다."
    ),
    5 => array(
        "name" => "오피서 프로치다 백 - 블랙",
        "price" => "273,000원",
        "sale" => "259,350원",
        "image" => "/shopmall/image/bag5.png",
        "description" => "다양한 룩에 어울리는 실용적인 블랙 오피서 프로치다 백입니다."
    ),
    6 => array(
        "name" => "서니 드라이 프로치다 백 - 빈티지 블랙",
        "price" => "329,000원",
        "sale" => "312,550원",
        "image" => "/shopmall/image/bag6.png",
        "description" => "빈티지한 감성이 돋보이는 블랙 서니 드라이 프로치다 백입니다."
    ),
    7 => array(
        "name" => "서니 드라이 프로치다 백 - 빈티지 브라운",
        "price" => "329,000원",
        "sale" => "312,550원",
        "image" => "/shopmall/image/bag7.png",
        "description" => "빈티지 브라운 컬러로 차분하면서도 고급스러운 서니 드라이 백입니다."
    ),
    8 => array(
        "name" => "오피서 프로치다 백 - 그레이",
        "price" => "273,000원",
        "sale" => "259,350원",
        "image" => "/shopmall/image/bag8.png",
        "description" => "실용성과 모던한 감각을 겸비한 그레이 오피서 프로치다 백입니다."
    ),
    9 => array(
        "name" => "프로치다 백 - 빈티지 브라운",
        "price" => "367,000원",
        "sale" => "348,650원",
        "image" => "/shopmall/image/bag9.png",
        "description" => "빈티지 브라운 컬러가 돋보이는 클래식한 프로치다 백입니다."
    ),

);

// 모든 상품에 추가 이미지 배열 추가
foreach ($products as $key => $product) {
    if (isset($product['image'])) {
        $baseImage = str_replace('.png', '', $product['image']);
        $additionalImages = array();
        for ($i = 1; $i <= 11; $i++) {
            $additionalImages[] = $baseImage . '-' . $i . '.png';
        }
        $products[$key]['additional_images'] = $additionalImages;
    }
}

// GET 파라미터로 받은 제품 ID
$productId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$product = isset($products[$productId]) ? $products[$productId] : null;

// 제품이 없을 경우 처리
if (!$product) {
    echo "<h1>제품 정보를 찾을 수 없습니다.</h1>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail.css">
    <title><?php echo htmlspecialchars($product['name']); ?> - 상세 정보</title>
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
    <div class="container">
        <!-- 제품 이미지 -->
        <div class="product-image">
            <!-- 메인 이미지 -->
            <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <!-- 추가 이미지 섹션 -->
            <?php if (!empty($product['additional_images'])): ?>
                <div class="additional-images">
                    <?php foreach ($product['additional_images'] as $additionalImage): ?>
                        <img src="<?php echo $additionalImage; ?>" alt="추가 이미지">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>추가 이미지는 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 제품 상세 정보 -->
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <div class="price">
                <span class="original-price"><?php echo $product['price']; ?></span>
                <span class="sale-price"><?php echo $product['sale']; ?></span>
            </div>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <div class="product-options">
                <select>
                    <option>사이즈 선택</option>
                    <option>Small</option>
                    <option>Medium</option>
                    <option>Large</option>
                </select>
            </div>
            <div>
                <button class="buy-now">구매하기</button>
                <button class="add-to-cart">장바구니 담기</button>
            </div>
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">상품 상세 설명</div>
                    <div class="accordion-content">상세 설명 내용이 들어갑니다.</div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">배송 정보</div>
                    <div class="accordion-content">배송 관련 정보가 들어갑니다.</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 아코디언 기능 추가
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });

        // 스크롤 따라 내려오는 제품 상세 정보
        window.addEventListener("scroll", () => {
            const details = document.querySelector(".product-details");
            const offsetTop = 20; // 상단 여유 공간
            const scrollY = window.scrollY; // 현재 스크롤 위치
            const containerTop = details.parentElement.offsetTop; // 부모 컨테이너의 상단 위치
            const containerHeight = details.parentElement.offsetHeight; // 부모 컨테이너의 높이
            const detailsHeight = details.offsetHeight; // 상세 정보의 높이

            // 새로운 위치 계산
            let newTop = Math.min(
                scrollY - containerTop + offsetTop,
                containerHeight - detailsHeight
            );

            // 시작 위치보다 위로 스크롤할 경우 원래 위치 유지
            newTop = Math.max(newTop, 0);

            details.style.transform = `translateY(${newTop}px)`;
        });
    </script>
</body>
</html>
