<?php
  $link = mysqli_connect('localhost', 'admin', 'admin', 'world');
  $query = "SELECT * FROM country ORDER BY Code ASC";
  $result = mysqli_query($link, $query);  
  $world_info = '';
  while($row = mysqli_fetch_array($result)) {
    $world_info .= '<tr>';
    $world_info .= '<td>'.$row['Code'].'</td>';
    $world_info .= '<td>'.$row['Name'].'</td>';
    $world_info .= '<td>'.$row['Continent'].'</td>';
    $world_info .= '<td>'.$row['Region'].'</td>';
    $world_info .= '<td>'.$row['SurfaceArea'].'</td>';
    $world_info .= '<td>'.$row['IndepYear'].'</td>';    
    $world_info .= '<td>'.$row['Population'].'</td>';    
    $world_info .= '<td>'.$row['LifeExpectancy'].'</td>';    
    $world_info .= '</tr>';
  }  
  
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>All about the World</title>
</head>

<body>
    
    <h2><a href="index.php">All about the World</a> | 국가별 정보 조회</h2>
    <table border="1">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Continent</th>
            <th>Region</th>
            <th>SurfaceArea</th>
            <th>IndepYear</th>
            <th>Population</th>
            <th>LifeExpectancy</th>
        </tr>
        <?= $world_info ?>

    </table>
</body>

</html>
