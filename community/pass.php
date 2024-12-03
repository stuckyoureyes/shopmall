<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>암호 확인</title>
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
            text-align: center;
        }
        table {
            font-size: 15px;
            border-collapse: collapse;
            width: 400px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        td {
            padding: 15px;
            text-align: center;
        }
        input[type="password"] {
            width: 80%;
            padding: 10px;
            font-size: 14px;
            margin: 10px 0;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 14px;
            color: white;
            background-color: #FFCCCC;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #FF9999;
        }
    </style>
</head>
<body>
<?php
// GET 파라미터 확인 및 검증
$board = isset($_GET['board']) ? htmlspecialchars($_GET['board'], ENT_QUOTES, 'UTF-8') : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$mode = isset($_GET['mode']) ? intval($_GET['mode']) : -1;

if (empty($board) || $id <= 0 || $mode < 0) {
    die("<script>alert('잘못된 요청입니다.'); history.go(-1);</script>");
}

echo "
    <form method='post' action='pass2.php?board=$board&id=$id&mode=$mode'>
    <table>
        <tr>
            <td><strong>암호를 입력하세요</strong></td>
        </tr>
        <tr>
            <td>
                <input type='password' name='pass' required placeholder='암호를 입력하세요'>
                <br>
                <input type='submit' value='입력'>
            </td>
        </tr>
    </table>
    </form>
";
?>
</body>
</html>
