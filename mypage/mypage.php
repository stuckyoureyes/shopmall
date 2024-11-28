<?php
// 임의의 데이터 설정 (데이터베이스 연결 없이 기본 값으로 설정)
$orderCount = 0;
$cartCount = 0;
$mileage = 0;

$orderStatus = array(
    '입금전' => 0,
    '배송준비중' => 0,
    '배송중' => 0,
    '배송완료' => 0,
    '취소' => 0,
    '교환' => 0,
    '반품' => 0,
);

$accountDetails = array(
    array("Order Tracking", "고객님께서 주문하신 상품의 주문내역을 확인하실 수 있습니다."),
    array("Profile", "회원님의 개인 정보를 관리하는 공간입니다."),
    array("Wishlist", "관심상품으로 등록하신 상품의 목록을 보여드립니다."),
    array("Board", "고객님께서 작성하신 게시물을 관리하는 공간입니다."),
    array("Mileage", "적립금을 상품 구매 시 사용하실 수 있습니다."),
    array("Coupon", "고객님의 보유 쿠폰 목록을 보여드립니다."),
    array("Address", "자주 사용하는 배송지를 등록하고 관리하실 수 있습니다.")
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
    <header class="header">
        <div class="logo">KIMGOON</div>
        <nav class="nav">
            <a href="#">Shop</a>
            <a href="#">KIMGOON</a>
            <a href="#">About</a>
            <a href="#">My Account</a>
        </nav>
        <div class="header-right">
            <span>Language : KR</span>
            <a href="#">Login</a>
            <a href="#">Cart</a>
        </div>
    </header>
    
    <main class="main-content">
        <section class="account-overview">
            <h2>My Account</h2>
            <div class="account-summary">
                <div>Order <?php echo $orderCount; ?> /</div>
                <div>Cart <?php echo $cartCount; ?></div>
                <div>Mileage <?php echo $mileage; ?>원</div>
            </div>
            <h3>나의 주문처리 현황</h3>
            <br>
            <div class="order-status">
                <?php foreach ($orderStatus as $status => $count) : ?>
                    <div><?php echo $status; ?> <?php echo $count; ?></div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section class="account-details">
            <ul>
                <?php foreach ($accountDetails as $index => $detail) : ?>
                    <li>
                        <strong><?php printf("%02d", $index + 1); ?></strong> <?php echo $detail[0]; ?>
                        <span><?php echo $detail[1]; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
    
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
