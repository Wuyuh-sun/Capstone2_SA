<?
include("./db_connect.php");
session_start();

$data = array(
  'jsonDataArray'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
);

$sql = "select * from faq_good_data where 
        click_user='{$_SESSION['usernickname']}' AND
        placename='{$data['jsonDataArray']['placename']}' AND
        title='{$data['jsonDataArray']['title']}' AND
        content_idx='{$data['jsonDataArray']['idx']}'
        ";
$result = mysqli_query($conn, $sql);
// print_r($result);
$row = mysqli_fetch_array($result);
// echo $row['click_user'];
if($row['click_user'] == ''){
  echo '1';
  $insert_sql = "
  INSERT INTO faq_good_data(click_user, placename, title, content_idx, good) 
  VALUES (
    '{$_SESSION['usernickname']}',
    '{$data['jsonDataArray']['placename']}',
    '{$data['jsonDataArray']['title']}',
    '{$data['jsonDataArray']['idx']}',
    1
    )
  ";
  $insert_result = mysqli_query($conn, $insert_sql);
  
  $sql2 = "select * from faq_main where idx='{$data['jsonDataArray']['idx']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2); 
    if($row2['good'] == NULL){
      $bbs_updateGood = "
      UPDATE faq_main 
      SET 
        good = 1
      WHERE
        idx='{$data['jsonDataArray']['idx']}'
      ";
      $bbs_updateGood_result = mysqli_query($conn, $bbs_updateGood);
    } else{
      $bbs_updateGood = "
      UPDATE faq_main 
      SET 
        good = good+1
      WHERE
        idx='{$data['jsonDataArray']['idx']}'
      ";
      $bbs_updateGood_result = mysqli_query($conn, $bbs_updateGood);
    }
} else{
  if($row['good'] == 1){
    echo '0';
    $update_sql = "
    UPDATE faq_good_data 
    SET 
      good = 0
    WHERE
      click_user='{$_SESSION['usernickname']}' AND
      placename='{$data['jsonDataArray']['placename']}' AND
      title='{$data['jsonDataArray']['title']}' AND
      content_idx='{$data['jsonDataArray']['idx']}' AND
      good = 1
    ";
    $update_result = mysqli_query($conn, $update_sql);

    $bbs_updateGood = "
    UPDATE faq_main 
    SET 
      good = good-1
    WHERE
      idx='{$data['jsonDataArray']['idx']}'
    ";
    $bbs_updateGood_result = mysqli_query($conn, $bbs_updateGood);
    
  } else{
    echo '1';
    $update_sql = "
    UPDATE faq_good_data 
    SET 
      good = 1
    WHERE
      click_user='{$_SESSION['usernickname']}' AND
      placename='{$data['jsonDataArray']['placename']}' AND
      title='{$data['jsonDataArray']['title']}' AND
      content_idx='{$data['jsonDataArray']['idx']}' AND
      good = 0
    ";
    $update_result = mysqli_query($conn, $update_sql);

    $bbs_updateGood = "
    UPDATE faq_main 
    SET 
      good = good+1
    WHERE
      idx='{$data['jsonDataArray']['idx']}'
    ";
    $bbs_updateGood_result = mysqli_query($conn, $bbs_updateGood);
  }
}


// echo $data['jsonDataArray']['placename'];
// echo $data['jsonDataArray']['title'];
// echo $data['jsonDataArray']['idx'];

?>