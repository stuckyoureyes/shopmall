<?php
// 에러 보고 설정 (디버깅을 위해 필요 시 유지)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// UTF-8 설정
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// 게시글 ID 가져오기
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 댓글 데이터 가져오기
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$wdate = date("Y-m-d H:i:s");

// 필수 입력값 확인
if (empty($name) || empty($message)) {
    echo "<script>alert('이름과 내용을 입력해주세요.'); history.go(-1);</script>";
    exit;
}

// 게시글 존재 여부 확인
$stmt = mysqli_prepare($con, "SELECT COUNT(*) FROM testboard WHERE id = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $post_exists);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($post_exists == 0) {
        echo "<script>alert('존재하지 않는 게시글입니다.'); history.go(-1);</script>";
        exit;
    }
} else {
    die("게시글 확인 중 오류가 발생했습니다: " . mysqli_error($con));
}

// 댓글 저장
$stmt = mysqli_prepare($con, "INSERT INTO memojang (id, name, message, wdate) VALUES (?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "isss", $post_id, $name, $message, $wdate);
    if (mysqli_stmt_execute($stmt)) {
        // 댓글 작성 성공 시 게시글 페이지로 리다이렉트
        header("Location: content.php?id=$post_id");
        exit;
    } else {
        die("댓글 작성 중 오류가 발생했습니다: " . mysqli_error($con));
    }
    mysqli_stmt_close($stmt);
} else {
    die("SQL 준비 중 오류가 발생했습니다: " . mysqli_error($con));
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
