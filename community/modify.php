<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <style>
        @font-face {
            font-family: 'Pretendard-Regular';
            src: url('https://cdn.jsdelivr.net/gh/Project-Noonnu/noonfonts_2107@1.1/Pretendard-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }
        body {
            font-family: 'Pretendard-Regular';
            background-color: #FFE9E9;
            padding: 20px;
        }
        table {
            width: 700px;
            margin: auto;
            background-color: white;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        td.label {
            text-align: right;
            font-weight: bold;
            width: 20%; 
        }
        h1 {
            text-align: center;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });
        });
    </script>
</head>
<body>
<?php
// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// GET 파라미터 처리
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 게시글 데이터 가져오기
$stmt = mysqli_prepare($con, "SELECT writer, topic, content FROM testboard WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

// 데이터 바인딩
mysqli_stmt_bind_result($stmt, $writer, $topic, $content);
if (!mysqli_stmt_fetch($stmt)) {
    die("<script>alert('게시글을 찾을 수 없습니다.'); history.go(-1);</script>");
}

mysqli_stmt_close($stmt);
mysqli_close($con);

// HTML 특수 문자를 변환
$writer = htmlspecialchars($writer, ENT_QUOTES, 'UTF-8');
$topic = htmlspecialchars($topic, ENT_QUOTES, 'UTF-8');
$content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
?>

<h1>게시글 수정</h1>
<form method="post" action="cprocess.php?id=<?= $id ?>" enctype="multipart/form-data">
    <table>
        <tr>
            <td class="label">작성자:</td>
            <td><input type="text" name="writer" size="20" value="<?= $writer ?>" required></td>
        </tr>
        <tr>
            <td class="label">제목:</td>
            <td><input type="text" name="topic" size="60" value="<?= $topic ?>" required></td>
        </tr>
        <tr>
            <td class="label">첨부파일:</td>
            <td><input type="file" name="userfile" size="45"></td>
        </tr>
        <tr>
            <td class="label">내용:</td>
            <td><textarea name="content" rows="12" cols="60" id="summernote" required><?= $content ?></textarea></td>
        </tr>
        <tr>
            <td class="label">암호:</td>
            <td><input type="password" name="passwd" size="15" required></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" class="btn btn-primary" value="수정 완료">
                <input type="reset" class="btn btn-danger" value="취소">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
