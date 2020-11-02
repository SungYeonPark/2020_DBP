<?php 
    $link = mysqli_connect('localhost', 'admin', 'admin', 'world');

    if (mysqli_connect_errno()) {
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connet_error();
        exit();
    }

    $filtered_country = mysqli_real_escape_string($link, $_POST['Country']);
    $country_query = "SELECT Name FROM country WHERE Name='{$filtered_country}'";
    $country_result = mysqli_query($link, $country_query);
    $country_row = mysqli_fetch_array($country_result)['Name'];

    $query = "
        SELECT lan.Language, lan.IsOfficial, lan.Percentage
        FROM countrylanguage lan
        LEFT JOIN country cn
        ON lan.CountryCode = cn.Code
        WHERE cn.Name = '{$filtered_country}'    
        ORDER BY lan.Percentage DESC
    ";

 

    $result = mysqli_query($link, $query);
    $country = mysqli_fetch_array($result);
    $article = '';

    

    while ($row = mysqli_fetch_array($result)) {
        $article .= '<tr><td>';
        $article .= $row['Language'];
        $article .= '</td><td>';
        $article .= $row['IsOfficial'];
        $article .= '</td><td>';
        $article .= $row['Percentage'];
        $article .= '</td></tr>';
    }
    mysqli_free_result($result);
    mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>국가별 언어 정보</title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table{
            width: 100%;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada
        }
    </style>
</head>
<body>
        <h2><a href="index.php">All about the world</a> |<?= $filtered_country?> 언어 정보</h2>
        <table>
            <tr>
                <th>Language</th>
                <th>IsOfficial</th>
                <th>Percentage</th>
            </tr>
            <?=$article?>
        </table>
</body>
</html>
