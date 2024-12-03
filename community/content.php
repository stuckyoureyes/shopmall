<?php
// UTF-8 설정
header("Content-Type: text/html; charset=UTF-8");

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "apmsetup", "comma");
if (!$con) {
    die("MySQL 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");

// 게시글 ID 가져오기
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 게시글 데이터 가져오기
$stmt = mysqli_prepare($con, "SELECT writer, topic, content, hit, wdate, filename FROM testboard WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $writer, $topic, $content, $hit, $wdate, $filename);

if (!mysqli_stmt_fetch($stmt)) {
    echo "<script>alert('게시글을 찾을 수 없습니다.'); history.go(-1);</script>";
    exit;
}
mysqli_stmt_close($stmt);

// 조회수 증가
$hit++;
$update_stmt = mysqli_prepare($con, "UPDATE testboard SET hit = ? WHERE id = ?");
mysqli_stmt_bind_param($update_stmt, "ii", $hit, $id);
mysqli_stmt_execute($update_stmt);
mysqli_stmt_close($update_stmt);

// HTML 출력 시작
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 보기</title>
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
            padding: 0;
        }
        h1 {
            text-align: center;
            font-weight: bold;
            color: #333;
            padding: 20px 0;
        }
        .post-container {
            margin: 0 auto;
            width: 700px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .post-header {
            background-color: #FFCCCC;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .post-header h2 {
            margin: 0;
            font-size: 24px;
        }
        .post-details {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .post-details span {
            display: inline-block;
            margin-right: 20px;
            font-size: 14px;
            color: #555;
        }
        .post-content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .post-content pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .attachment {
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .attachment a {
            color: #FF6666;
            text-decoration: none;
        }
        .attachment a:hover {
            text-decoration: underline;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: white;
            background-color: #FFCCCC;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            margin: 5px;
        }
        .btn:hover {
            background-color: #FF9999;
        }
        .comment-section {
            margin: 20px auto;
            width: 700px;
        }
        .comment-section h2 {
            font-size: 20px;
            padding: 10px 0;
            border-bottom: 2px solid #FFCCCC;
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .comment .comment-author {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }
        .comment .comment-content {
            padding: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .comment .comment-date {
            font-size: 12px;
            color: gray;
        }
        .comment .comment-actions {
            text-align: right;
            margin-top: 5px;
        }
        .comment-actions .btn {
            font-size: 12px;
            padding: 5px 10px;
            margin: 0 2px;
        }
        .comment-form {
            margin: 20px auto;
            width: 700px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comment-form h2 {
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #FFCCCC;
            padding-bottom: 10px;
        }
        .comment-form p {
            margin: 10px 0;
        }
        .comment-form input[type="text"], .comment-form textarea {
            width: 100%;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .comment-form input[type="text"]:focus, .comment-form textarea:focus {
            border-color: #FF9999;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 153, 153, 0.5);
        }
        .comment-form input[type="submit"] {
            width: auto;
            background-color: #FFCCCC;
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 14px;
        }
        .comment-form input[type="submit"]:hover {
            background-color: #FF9999;
        }
    </style>
</head>
<body>
    <h1>게시판</h1>
    <div class="post-container">
        <div class="post-header">
            <h2><?php echo htmlspecialchars($topic); ?></h2>
        </div>
        <div class="post-details">
            <span>작성자: <?php echo htmlspecialchars($writer); ?></span>
            <span>작성일: <?php echo $wdate; ?></span>
            <span>조회 수: <?php echo $hit; ?></span>
        </div>
        <div class="post-content">
            <?php echo nl2br(($content)); ?>
        </div>
        <?php if (!empty($filename)) {
            $file_path = "../uploads/$filename"; // 업로드된 파일 경로
        ?>
        <div class="attachment">
            <b>첨부파일:</b> <a href="<?php echo htmlspecialchars($file_path); ?>" download="<?php echo htmlspecialchars($filename); ?>"><?php echo htmlspecialchars($filename); ?></a>
        </div>
        <?php } ?>
        <div class="btn-container">
            <a href="reply.php?board=testboard&id=<?php echo $id; ?>" class="btn">답글</a>
            <a href="pass.php?board=testboard&id=<?php echo $id; ?>&mode=0" class="btn">수정하기</a>
            <a href="pass.php?board=testboard&id=<?php echo $id; ?>&mode=1" class="btn">삭제하기</a>
            <a href="show.php" class="btn">목록</a>
        </div>
    </div>

    <div class="comment-section">
        <h2>댓글</h2>
        <?php
        // 댓글 가져오기
        $comment_stmt = mysqli_prepare($con, "SELECT num, name, message, wdate FROM memojang WHERE id = ? ORDER BY num DESC");
        mysqli_stmt_bind_param($comment_stmt, "i", $id);
        mysqli_stmt_execute($comment_stmt);
        mysqli_stmt_bind_result($comment_stmt, $comment_num, $comment_name, $comment_message, $comment_date);

        $has_comments = false;
        while (mysqli_stmt_fetch($comment_stmt)) {
            $has_comments = true;
        ?>
        <div class="comment">
            <div class="comment-author"><?php echo htmlspecialchars($comment_name); ?></div>
            <div class="comment-content"><?php echo nl2br(htmlspecialchars($comment_message)); ?></div>
            <div class="comment-date"><?php echo $comment_date; ?></div>
            <div class="comment-actions">
                <a href="mmodify.php?num=<?php echo $comment_num; ?>&id=<?php echo $id; ?>" class="btn">수정</a>
                <a href="mdelete.php?num=<?php echo $comment_num; ?>&id=<?php echo $id; ?>" class="btn">삭제</a>
            </div>
        </div>
        <?php
        }
        mysqli_stmt_close($comment_stmt);

        if (!$has_comments) {           
            echo "<p>댓글이 없습니다.</p>";
        }
        ?>
    </div>

    <div class="comment-form">
        <h2>댓글 작성</h2>
        <form method="post" action="comment_process.php?id=<?php echo $id; ?>">
            <p>
                <input type="text" name="name" placeholder="이름" required>
            </p>
            <p>
                <textarea name="message" rows="4" placeholder="내용" required></textarea>
            </p>
            <p style="text-align: center;">
                <input type="submit" value="댓글 등록">
            </p>
        </form>
    </div>
</body>
</html>
<?php
mysqli_close($con);
?>
