<?php
  $link = mysqli_connect("localhost", "root", "rootroot", "movie");
  $filtered = array(
    'title' => mysqli_real_escape_string($link, $_POST['title']),   //sql injection 막음
    'description' => mysqli_real_escape_string($link, $_POST['description']),
    'studio_id' => mysqli_real_escape_string($link, $_POST['studio_id'])
  );
  $query = "
  INSERT INTO topic
          (title, description, created, studio_id)
          VALUES(
              '{$filtered['title']}',
              '{$filtered['description']}',
              NOW(),
              '{$filtered['studio_id']}'
          )

  ";

$result = mysqli_multi_query($link, $query);
if ($result == false) {
    echo '저장하는 과정에서 문제가 발생했습니다. 관라자에게 문의하세요.';
    error_log(mysqli_error($link));
} else {
    echo '성공했습니다. <a href="index.php">돌아가기</a>';
}
