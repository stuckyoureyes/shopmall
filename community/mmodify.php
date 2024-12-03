<?php
// UTF-8 설정
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// GET 파라미터로부터 댓글 번호(`num`)와 게시글 ID(`id`)를 가져옵니다.
$comment_num = isset($_GET['num']) ? intval($_GET['num']) : 0;
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 댓글 정보를 데이터베이스에서 가져옵니다.
$stmt = mysqli_prepare($con, "SELECT name, message, wdate FROM memojang WHERE num = ?");
mysqli_stmt_bind_param($stmt, "i", $comment_num);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $message, $wdate);

if (!mysqli_stmt_fetch($stmt)) {
    echo "<script>alert('댓글을 찾을 수 없습니다.'); history.go(-1);</script>";
    exit;
}
mysqli_stmt_close($stmt);

// 데이터베이스 연결 종료
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>댓글 수정</title>
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
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            background-color: white;
            border-collapse: collapse;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        td, th {
            padding: 10px;
            font-size: 15px;
            word-wrap: break-word;
            white-space: pre-wrap;
            overflow-wrap: break-word;
            vertical-align: top;
        }
        th {
            background-color: #FFCCCC;
            text-align: center;
            font-size: 18px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            color: white;
            background-color: #FFCCCC;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .button:hover {
            background-color: #FF9999;
        }
        .cancel-button {
            background-color: #FFCCCC;
        }
        .cancel-button:hover {
            background-color: #FF9999;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: none;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">댓글 수정</h1>
    <form method="post" action="mprocess.php">
        <input type="hidden" name="num" value="<?= $comment_num ?>">
        <input type="hidden" name="id" value="<?= $post_id ?>">
        <table>
            <tr>
                <th colspan="2">댓글 수정</th>
            </tr>
            <tr>
                <td style="text-align: right;">작성자:</td>
                <td><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required></td>
            </tr>
            <tr>
                <td style="text-align: right;">내용:</td>
                <td><textarea name="message" rows="5" class="form-control" required><?= htmlspecialchars($message) ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" class="button" value="수정완료">
                    <a href="content.php?id=<?= $post_id ?>" class="button cancel-button">취소</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
