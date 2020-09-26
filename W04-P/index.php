<?php
  $link = mysqli_connect('localhost', 'root', 'rootroot', 'movie');
  $query = "SELECT * FROM topic";
  $result = mysqli_query($link, $query);
  $list ='';
  while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";  //get방식
  }

  $article = array(
     'title' => 'Welcome',
     'description' => '★ANIMATION MOVIE★'
   );
   $update_link = '';
   $delete_link = '';
   $studio = '';

   if (isset($_GET['id'])) {
       $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
       $query = "SELECT * FROM topic LEFT JOIN studio ON topic.studio_id =
       studio.id WHERE topic.id={$filtered_id}";
       $result = mysqli_query($link, $query);
       $row = mysqli_fetch_array($result);
       $article['title'] = htmlspecialchars($row['title']);
       $article['description'] = htmlspecialchars($row['description']);
       $article['name'] = htmlspecialchars($row['name']);

       $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
       $delete_link = '
      <form action="process_delete.php" method="POST">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="delete">
      </form>
      ';
       $studio = "<p>by {$article['name']}</p>";
   }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MOVIE</title>
  </head>
  <body>
    <h1><a href="index.php">★ANIMATION MOVIE★ </a></h1>
    <a href="studio.php">studio</a>
    <ol> <?= $list ?> </ol>
    <a href="create.php">create</a>
    <?=$update_link?>
    <?=$delete_link?>
    <h2><?=$article['title'] ?></h2>
    <?=$article['description'] ?>
    <?= $studio ?>
  </body>
</html>
