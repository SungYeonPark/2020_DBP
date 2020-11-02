<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'world');
    $query = "SELECT * FROM country ORDER BY Name ASC";
    $result = mysqli_query($link, $query);
    $country = '';
    while($row = mysqli_fetch_array($result)){
        $country .= '<option value ="'."{$row['Name']}".'">'."{$row['Name']}".'</option>';
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> All about the World </title>
</head>

<body>
    <h1> All about the World </h1>
    <a href="world_select.php">(1) 국가별 정보 조회</a><br>
    <form action="city_info.php" method="POST">
            <label>(2) 국가별 도시 정보 </label>
            <select name="Country">
                <option value="" >--Select--</option>
                <?= $country ?>
            </select>
            <input type="submit" value="Search">
    </form>

    <form action="GNP_info.php" method="GET">
        (3) GNP 정보:
        <input type="text" name="number" placeholder="number">
        <input type="submit" value="Search">
    </form>
    <form action="lang_info.php" method="POST">
            <label>(4) 국가별 언어 정보 </label>
            <select name="Country">
                <option value="" >--Select--</option>
                <?= $country ?>
            </select>
            <input type="submit" value="Search">
    </form>
</body>

</html>
