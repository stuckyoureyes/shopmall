<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판 답변 작성</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            font-weight: bold;
            color: #333;
            padding: 20px 0;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 700px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        td {
            padding: 15px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }
        td:first-child {
            width: 20%;
            background-color: #f8f8f8;
            font-weight: bold;
            text-align: right;
            vertical-align: middle;
        }
        td:last-child {
            width: 80%;
        }
        td input, td textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        td input:focus, td textarea:focus {
            border-color: #FF9999;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 153, 153, 0.5);
        }
        td[colspan="2"] {
            text-align: center;
            border: none;
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
        }
        .btn:hover {
            background-color: #FF9999;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 300
            });

            // Submit 시 Summernote 내용을 textarea로 동기화
            $('form').on('submit', function() {
                const markupStr = $('#summernote').summernote('code');
                $('textarea[name="content"]').val(markupStr);
            });
        });
    </script>
</head>
<body>
    <h1>게시판 답변 작성</h1>
    <form method="post" action="rprocess.php?board=<?= $board ?>&id=<?= $id ?>">
        <table>
            <tr>
                <td>이름</td>
                <td><input type="text" name="writer" size="40" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" size="40"></td>
            </tr>
            <tr>
                <td>제목</td>
                <td><input type="text" name="topic" size="60" value="<?= $topic ?>" required></td>
            </tr>
            <tr>
                <td>내용</td>
                <td>
                    <textarea id="summernote" name="content"><?= $pre_content ?></textarea>
                </td>
            </tr>
            <tr>
                <td>암호</td>
                <td><input type="password" name="passwd" size="20" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" value="답변 완료">
                    <input type="reset" class="btn" value="지우기">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
