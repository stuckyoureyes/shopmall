<?php
$conn = new mysqli('localhost', 'root', 'apmsetup', 'shopmall');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $detailed_address = $_POST['detailed_address'];
    $birth_date = $_POST['birth_date'];
    $nickname = $_POST['nickname'];

    $query1 = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('sss', $username, $password, $email);

    if ($stmt1->execute()) {
        $user_id = $stmt1->insert_id;
        $query2 = "INSERT INTO user_details (user_id, phone_number, address, detailed_address, birth_date, nickname) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param('isssss', $user_id, $phone, $address, $detailed_address, $birth_date, $nickname);

        if ($stmt2->execute()) {
            header('Location: ../login/login.php?signup=success');
            exit();
        } else {
            $error = "Error saving user details.";
        }
    } else {
        $error = "Error creating user account.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>회원가입</h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">아이디 *</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">비밀번호 *</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="name">이름 *</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="birth_date">생년월일 *</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <div class="form-group">
                <label for="nickname">닉네임 *</label>
                <input type="text" id="nickname" name="nickname" required>
            </div>
            <div class="form-group">
                <label for="address">주소 *</label>
                <div class="address-group">
                    <input type="text" id="address" name="address" readonly required>
                    <button type="button" onclick="execDaumPostcode()">주소 검색</button>
                </div>
            </div>
            <div class="form-group">
                <label for="detailed_address">상세 주소 *</label>
                <input type="text" id="detailed_address" name="detailed_address" required>
            </div>
            <div class="form-group">
                <label for="phone">휴대전화 *</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">이메일 *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">회원가입</button>
        </form>
    </div>
    <script>
        function execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    document.getElementById("address").value = data.address;
                }
            }).open();
        }
    </script>
</body>
</html>
