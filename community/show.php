<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- 헤더 -->
    <header>
        <div class="logo"><a href="main.php">KIMGOON</a></div>
        <nav>
            <a href="main.php">HOME</a>
            <a href="../shop/shop.php">SHOP</a>
            <div>
                <a href="#">COMMUNITY</a>
                <ul>
                    <li><a href="/board/free/list.html?board_no=1">NEWS&amp;EVENT</a></li>
                    <li><a href="/product/list_portfolio.html?cate_no=45">COLLECTION</a></li>
                    <li><a href="/board/product/list.html?board_no=4">REVIEW</a></li>
                    <li><a href="/board/product/list.html?board_no=6">Q&amp;A</a></li>
                </ul>
            </div>
            <a href="#">CONTACT</a>
        </nav>
    </header>

    <?php
    // MySQL 연결 설정
    $con = mysqli_connect("localhost", "root", "apmsetup", "comma");

    // 연결 오류 확인
    if (mysqli_connect_errno()) {
        die("MySQL 연결 실패: " . mysqli_connect_error());
    }

    mysqli_set_charset($con, "utf8");

    $search_query = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
    $search_type = isset($_GET['type']) ? mysqli_real_escape_string($con, $_GET['type']) : 'topic';

    $search_column = ($search_type === 'writer') ? 'writer' : (($search_type === 'content') ? 'content' : 'topic');

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 15;
    $offset = ($page - 1) * $limit;

    $count_sql = "SELECT COUNT(*) as total_count FROM testboard";
    if (!empty($search_query)) {
        $count_sql .= " WHERE $search_column LIKE '%$search_query%'";
    }
    $count_result = mysqli_query($con, $count_sql);
    $total_posts = mysqli_fetch_assoc($count_result)['total_count'];
    $total_pages = ceil($total_posts / $limit);

    $sql = "
        SELECT t.*, 
        (SELECT topic FROM testboard p WHERE p.id = t.space) AS parent_topic,
        (SELECT COUNT(*) FROM memojang m WHERE m.id = t.id) AS comment_count
        FROM testboard t
    ";
    if (!empty($search_query)) {
        $sql .= " WHERE $search_column LIKE '%$search_query%'";
    }
    $sql .= " ORDER BY wdate DESC LIMIT $offset, $limit";
    $result = mysqli_query($con, $sql);

    echo("<h1>게시판</h1>");
    echo("<table><thead><tr>
        <th>번호</th><th>글쓴이</th><th>제목</th><th>날짜</th><th>조회</th></tr></thead><tbody>");

    if ($total_posts == 0) {
        echo("<tr><td colspan='5'>검색 결과가 없습니다.</td></tr>");
    } else {
        $counter = $total_posts - $offset;
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $writer = htmlspecialchars($row['writer']);
            $topic = htmlspecialchars($row['topic']);
            $wdate = $row['wdate'];
            $hit = $row['hit'];
            $comment_count = $row['comment_count'];
            $filename = $row['filename'];
            $parent_topic = $row['parent_topic'] ? htmlspecialchars($row['parent_topic']) : "";

            $display_topic = !empty($parent_topic) ? "[Re] $parent_topic - $topic" : $topic;
            $attachment_icon = !empty($filename) ? "<i class='fa-solid fa-link'></i>" : "";

            echo("<tr>
                <td>$counter</td>
                <td>$writer</td>
                <td><a href='content.php?board=testboard&id=$id'>$display_topic</a> $attachment_icon [$comment_count]</td>
                <td>$wdate</td>
                <td>$hit</td>
            </tr>");
            $counter--;
        }
    }
    echo("</tbody></table>");

    echo("<div class='pagination'>");
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i === $page) ? "class='active'" : "";
        echo("<a href='show.php?page=$i&search=$search_query&type=$search_type' $active_class>$i</a>");
    }
    echo("</div>");

    echo("
        <div class='search-bar'>
            <form method='get' action='show.php'>
                <select name='type'>
                    <option value='topic' " . ($search_type === 'topic' ? 'selected' : '') . ">제목</option>
                    <option value='writer' " . ($search_type === 'writer' ? 'selected' : '') . ">작성자</option>
                    <option value='content' " . ($search_type === 'content' ? 'selected' : '') . ">내용</option>
                </select>
                <input type='text' name='search' value='" . htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8') . "' placeholder='검색어를 입력하세요'>
                <input type='submit' value='검색'>
            </form>
        </div>
        <div class='write-btn'><a href='input.php?board=testboard'>글쓰기</a></div>
    ");

    mysqli_close($con);
    ?>
</body>
</html>
