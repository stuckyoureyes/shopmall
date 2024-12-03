<?php
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("<script>alert('MySQL 연결 실패.'); history.go(-1);</script>");
}
mysqli_set_charset($con, "utf8mb4");

$board = isset($_GET['board']) ? htmlspecialchars($_GET['board'], ENT_QUOTES, 'UTF-8') : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$mode = isset($_GET['mode']) ? intval($_GET['mode']) : -1;

if (empty($board) || empty($id) || empty($pass) || $mode < 0) {
    echo "<script>alert('잘못된 요청입니다.'); history.go(-1);</script>";
    exit;
}

// 고정된 솔트
$salt = "a1b2c3d4e5f6g7h8";

// 비밀번호 확인
$stmt = mysqli_prepare($con, "SELECT passwd FROM $board WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $db_pass);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// 사용자가 입력한 비밀번호를 해싱
$hashed_input_pass = hash('sha256', $salt . $pass);

echo"$hashed_input_pass";

// 해싱된 비밀번호 비교
if ($hashed_input_pass !== $db_pass) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.go(-1);</script>";
    exit;
}

// 수정 또는 삭제 처리
if ($mode === 0) { // 수정
    echo "<meta http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>";
    exit;
} elseif ($mode === 1) { // 삭제
    echo "<meta http-equiv='Refresh' content='0; url=delete.php?board=$board&id=$id'>";
    exit;
} else {    
    echo "<script>alert('잘못된 요청입니다.'); history.go(-1);</script>";
    exit;
}

mysqli_close($con);
?>
