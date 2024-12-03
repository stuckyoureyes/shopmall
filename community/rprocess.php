<?php
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// POST 데이터 디버깅
// print_r($_POST); exit;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$writer = htmlspecialchars(trim($_POST['writer']));
$email = htmlspecialchars(trim($_POST['email']));
$topic = htmlspecialchars(trim($_POST['topic']));
$content = trim($_POST['content']); // HTML 태그 허용
$passwd = htmlspecialchars(trim($_POST['passwd']));
$wdate = date("Y-m-d H:i:s");

// 답글 저장
$stmt = mysqli_prepare($con, "INSERT INTO testboard (writer, email, topic, content, passwd, wdate, space) VALUES (?, ?, ?, ?, ?, ?, ?)");
$space = $id;
mysqli_stmt_bind_param($stmt, "ssssssi", $writer, $email, $topic, $content, $passwd, $wdate, $space);

if (!mysqli_stmt_execute($stmt)) {
    die("<script>alert('답글 작성 실패: " . mysqli_error($con) . "'); history.go(-1);</script>");
}

mysqli_stmt_close($stmt);
mysqli_close($con);

// 답글 작성 완료 후 이동
header("Location: show.php?id=$id");
exit;
?>
