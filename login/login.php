<?php
session_start();
$conn = new mysqli('localhost', 'root', 'apmsetup', 'shopmall');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // 로그인 성공 시 세션 저장
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username']; // 필요 시 추가 정보 저장

            // 메인 페이지로 리디렉션
            header('Location: ../main/main.php');
            exit();
        } else {
            $error = "비밀번호가 올바르지 않습니다.";
        }
    } else {
        $error = "사용자를 찾을 수 없습니다.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="../signup/signup.css">
</head>
<body>
    <div class="form-container">
        <h1>로그인</h1>
        <?php
        // 회원가입 성공 메시지 출력
        if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
            echo "<p class='success'>회원가입이 완료되었습니다! 로그인하세요.</p>";
        }
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">아이디</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">비밀번호</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">로그인</button>
            <p>아직 회원이 아니신가요? <a href="../signup/signup.php">회원가입</a></p>
        </form>
    </div>
</body>
</html>
