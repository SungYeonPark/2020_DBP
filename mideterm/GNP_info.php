<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'world');

    if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $filtered_number = mysqli_real_escape_string($link, $_GET['number']);
    
    $query = "
        SELECT Code, Name, GNP, GNPOld
        FROM country     
        ORDER BY GNP DESC
        LIMIT ".$filtered_number                 
    ;

    $result = mysqli_query($link, $query);  

    $article = '';    
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row["Code"];
        $article .= '</td><td>';
        $article .= $row["Name"];
        $article .= '</td><td>';
        $article .= $row["GNP"];
        $article .= '</td><td>';
        $article .= $row["GNPOld"];
        $article .= '</td></tr>';
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>GNP 정보</title>
    <style>
        body {
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>
</head>
<body>
    <h2><a href="index.php">All about the World</a> | GNP 정보</h2>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>GNP</th>
            <th>GNPOld</th>
        </tr>        
        <?= $article ?>
    </table>
</body>
</html>

