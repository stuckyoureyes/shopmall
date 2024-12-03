<?php
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// GET 데이터 처리
$board = isset($_GET['board']) ? htmlspecialchars($_GET['board'], ENT_QUOTES, 'UTF-8') : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($board) || $id <= 0) {
    echo "<script>alert('잘못된 요청입니다.'); history.go(-1);</script>";
    exit;
}

// 게시글 삭제
$stmt = mysqli_prepare($con, "DELETE FROM $board WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('글이 성공적으로 삭제되었습니다.'); location.href='show.php?board=$board';</script>";
} else {
    echo "<script>alert('글 삭제에 실패했습니다.'); history.go(-1);</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
