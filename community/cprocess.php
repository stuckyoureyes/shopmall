<?php
header("Content-Type: text/html; charset=UTF-8");
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "1. 스크립트 시작<br>";

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("<script>alert('MySQL 연결 실패: " . mysqli_connect_error() . "');</script>");
}
mysqli_set_charset($con, "utf8");
echo "2. 데이터베이스 연결 성공<br>";

// 필수 입력 값 확인
if (empty($_POST['writer']) || empty($_POST['content']) || empty($_POST['passwd'])) {
    echo "3. 필수 항목 누락<br>";
    echo ("<script>
        alert('모든 필수 항목을 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}
echo "4. 필수 입력 값 확인 완료<br>";

// POST 데이터 가져오기
$writer = htmlspecialchars(trim($_POST['writer']), ENT_QUOTES, 'UTF-8');
$topic = htmlspecialchars(trim($_POST['topic']), ENT_QUOTES, 'UTF-8');
$content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES, 'UTF-8');
$passwd = htmlspecialchars(trim($_POST['passwd']), ENT_QUOTES, 'UTF-8');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

echo "5. POST 데이터 수집 완료<br>";
echo "writer: $writer, topic: $topic, content: $content, passwd: $passwd, id: $id<br>";

// 현재 날짜 설정
$wdate = date("Y-m-d H:i:s");
echo "6. 날짜 설정 완료: $wdate<br>";

// 파일 업로드 처리
$temp = '';
$savedir = "./pds";
$userfile_size = 0;
if (!empty($_FILES['userfile']['name'])) {
    $userfile_name = $_FILES['userfile']['name'];
    $userfile_tmp = $_FILES['userfile']['tmp_name'];
    $userfile_size = $_FILES['userfile']['size'];

    $temp = str_replace(" ", "_", $userfile_name);

    echo "7. 파일 업로드 준비: $userfile_name, $userfile_tmp<br>";

    if (!move_uploaded_file($userfile_tmp, "$savedir/$temp")) {
        echo "8. 파일 업로드 실패<br>";
        echo ("<script>
            alert('파일 업로드에 실패했습니다.');
            history.go(-1);
        </script>");
        exit;
    }
    echo "8. 파일 업로드 성공: $temp<br>";
}

// 게시글 업데이트
$stmt = mysqli_prepare($con, "
    UPDATE testboard 
    SET writer = ?, wdate = ?, topic = ?, content = ?, passwd = ?, filename = ?, filesize = ? 
    WHERE id = ?
");
if (!$stmt) {
    echo "9. SQL 준비 실패<br>";
    echo "<script>
        alert('SQL 준비 실패: " . mysqli_error($con) . "');
        history.go(-1);
    </script>";
    exit;
}
echo "9. SQL 준비 완료<br>";

// 데이터 바인딩
mysqli_stmt_bind_param($stmt, "ssssssii", $writer, $wdate, $topic, $content, $passwd, $temp, $userfile_size, $id);
echo "10. 데이터 바인딩 완료<br>";

// SQL 실행
if (!mysqli_stmt_execute($stmt)) {
    echo "11. SQL 실행 실패<br>";
    echo "<script>
        alert('수정 실패: " . mysqli_stmt_error($stmt) . "');
        history.go(-1);
    </script>";
    exit;
}
echo "11. SQL 실행 성공<br>";

// 수정 완료 후 show.php로 이동
echo ("<script>
    alert('수정이 완료되었습니다.');
    location.href = 'show.php';
</script>");
echo "12. 수정 완료 후 이동<br>";

// 연결 해제
mysqli_stmt_close($stmt);
mysqli_close($con);

?>
