<?php
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// GET 데이터 처리
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$comment_num = isset($_GET['num']) ? intval($_GET['num']) : 0;

if (empty($id) || empty($comment_num)) {
    echo ("<script>
        alert('잘못된 요청입니다.');
        history.go(-1);
    </script>");
    exit;
}

// 댓글 삭제
$stmt = mysqli_prepare($con, "DELETE FROM memojang WHERE num = ?");
if (!$stmt) {
    die("쿼리 준비 실패: " . mysqli_error($con));
}
mysqli_stmt_bind_param($stmt, "i", $comment_num);
if (mysqli_stmt_execute($stmt)) {
    echo ("<script>
        alert('댓글이 삭제되었습니다.');
        location.href='content.php?id=$id';
    </script>");
} else {
    echo ("<script>
        alert('댓글 삭제에 실패했습니다.');
        history.go(-1);
    </script>");
    exit;
}
mysqli_stmt_close($stmt);

// 연결 종료
mysqli_close($con);
?>
