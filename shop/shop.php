<?php
// 상품 리스트 배열
$products = array(
    array("id" => 1, "name" => "오피서 백팩 - 그레이", "price" => "252,000원", "sale" => "239,400원", "image" => "/shopmall/image/bag1.png", "hover_image" => "/shopmall/image/bag1-1.png"),
    array("id" => 2, "name" => "오피서 백팩 - 블랙", "price" => "252,000원", "sale" => "239,400원", "image" => "/shopmall/image/bag2.png", "hover_image" => "/shopmall/image/bag2-1.png"),
    array("id" => 3, "name" => "프로치다 백 - 블랙", "price" => "357,000원", "sale" => "339,150원", "image" => "/shopmall/image/bag3.png", "hover_image" => "/shopmall/image/bag3-1.png"),
    array("id" => 4, "name" => "프로치다 백 - 누버크 브라운", "price" => "367,000원", "sale" => "348,650원", "image" => "/shopmall/image/bag4.png", "hover_image" => "/shopmall/image/bag4-1.png"),
    array("id" => 5, "name" => "오피서 프로치다 백 - 블랙", "price" => "273,000원", "sale" => "259,350원", "image" => "/shopmall/image/bag5.png", "hover_image" => "/shopmall/image/bag5-1.png"),
    array("id" => 6, "name" => "서니 드라이 프로치다 백 - 빈티지 블랙", "price" => "329,000원", "sale" => "312,550원", "image" => "/shopmall/image/bag6.png", "hover_image" => "/shopmall/image/bag6-1.png"),
    array("id" => 7, "name" => "서니 드라이 프로치다 백 - 빈티지 브라운", "price" => "329,000원", "sale" => "312,550원", "image" => "/shopmall/image/bag7.png", "hover_image" => "/shopmall/image/bag7-1.png"),
    array("id" => 8, "name" => "오피서 프로치다 백 - 그레이", "price" => "273,000원", "sale" => "259,350원", "image" => "/shopmall/image/bag8.png", "hover_image" => "/shopmall/image/bag8-1.png"),
    array("id" => 9, "name" => "프로치다 백 - 빈티지 브라운", "price" => "367,000원", "sale" => "348,650원", "image" => "/shopmall/image/bag9.png", "hover_image" => "/shopmall/image/bag9-1.png")
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Hip Shopping Experience</title>
    <link rel="stylesheet" href="shop.css"> <!-- Shop 전용 스타일 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
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

    <!-- 상품 목록 섹션 -->
    <section class="product-section">
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <!-- 제품 상세 페이지로 링크 -->
                    <a href="../product/detail.php?id=<?php echo $product['id']; ?>">
                        <!-- 기본 이미지 -->
                        <img 
                            src="<?php echo $product['image']; ?>" 
                            alt="<?php echo $product['name']; ?>" 
                            class="product-image"
                        >
                        <!-- Hover 시 보여줄 이미지 -->
                        <img 
                            src="<?php echo $product['hover_image']; ?>" 
                            alt="<?php echo $product['name']; ?> Hover Image" 
                            class="product-image-hover"
                        >
                        <div class="product-info">
                            <h3 class="product-name"><?php echo $product['name']; ?></h3>
                            <p class="product-price">
                                <span class="original-price"><?php echo $product['price']; ?></span>
                                <span class="sale-price"><?php echo $product['sale']; ?></span>
                                <span class="wish-list"><i class="fa-solid fa-heart"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 푸터 -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Left Section -->
            <div class="footer-left">
                <ul>
                    <li><a href="#">이용약관</a></li>
                    <li><a href="#">이용안내</a></li>
                    <li><a href="#">개인정보처리방침</a></li>
                </ul>
                <button class="chat-btn">채팅상담</button>
            </div>

            <!-- Center Section -->
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

            <!-- Right Section -->
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
