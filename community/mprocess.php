<?php
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// POST 데이터 처리
$comment_num = isset($_POST['num']) ? intval($_POST['num']) : 0;
$post_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// 데이터 유효성 검사
if (empty($comment_num) || empty($post_id) || empty($name) || empty($message)) {
    echo "<script>alert('모든 필드를 입력해야 합니다.'); history.go(-1);</script>";
    exit;
}

// 댓글 수정 쿼리 실행
$stmt = mysqli_prepare($con, "UPDATE memojang SET name = ?, message = ? WHERE num = ? AND id = ?");
if (!$stmt) {
    die("쿼리 준비 실패: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "ssii", $name, $message, $comment_num, $post_id);
if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('댓글이 성공적으로 수정되었습니다.'); location.href='content.php?id=$post_id';</script>";
} else {
    echo "<script>alert('댓글 수정에 실패했습니다.'); history.go(-1);</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
