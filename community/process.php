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

// 업로드 디렉토리 설정
$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

// 디렉토리 확인 및 생성
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0777, true)) {
        die("업로드 디렉토리를 생성하지 못했습니다: $upload_dir");
    }
}

// 파일 업로드 처리
$filename = null;
$file_path = null;
$file_size = 0;

if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['userfile']['tmp_name'];
        $original_name = basename($_FILES['userfile']['name']);

        // 파일 이름 단순화 (특수문자 제거, 길이 제한)
        $sanitized_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $original_name);
        $sanitized_name = substr($sanitized_name, -30); // 파일 이름의 마지막 30글자만 사용
        $filename = time() . "_" . $sanitized_name;

        // 파일 경로 생성
        $file_path = $upload_dir . $filename;
        $file_size = $_FILES['userfile']['size'];

        if (!is_writable($upload_dir)) {
        }

        // 임시 파일 존재 확인
        if (!file_exists($tmp_name)) {
            die("임시 파일이 존재하지 않습니다: $tmp_name");
        }

        // 파일 이동
        if (!move_uploaded_file($tmp_name, $file_path)) {
            die("파일 업로드에 실패했습니다.");
        }
    } else {
        die("파일 업로드 실패: " . $_FILES['userfile']['error']);
    }
}

// 게시글 데이터 저장 처리
$writer = isset($_POST['writer']) ? trim($_POST['writer']) : '';
$topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';
$passwd = isset($_POST['passwd']) ? trim($_POST['passwd']) : '';
$wdate = date("Y-m-d H:i:s");

// 필수 입력값 확인
if (empty($writer) || empty($topic) || empty($content) || empty($passwd)) {
    die("작성자, 제목, 내용 또는 비밀번호를 입력하지 않았습니다.");
}

// 비밀번호 해시 처리
$salt = "a1b2c3d4e5f6g7h8"; // 고정된 솔트
$hashed_passwd = hash('sha256', $salt . $passwd);

// SQL 실행
$stmt = mysqli_prepare($con, "INSERT INTO testboard (writer, topic, content, filename, filesize, file_path, wdate, passwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssssisss", $writer, $topic, $content, $filename, $file_size, $file_path, $wdate, $hashed_passwd);
    if (mysqli_stmt_execute($stmt)) {
        // 게시글 작성 성공 시 show.php로 리다이렉트
        header("Location: show.php");
        exit;
    } else {
        die("게시글 작성 중 오류가 발생했습니다: " . mysqli_error($con));
    }
    mysqli_stmt_close($stmt);
} else {
    die("SQL 준비 중 오류가 발생했습니다: " . mysqli_error($con));
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
