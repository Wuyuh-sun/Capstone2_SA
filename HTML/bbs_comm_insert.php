<?
include("./db_connect.php");
session_start();

$data = array(
  'bbs_idx'=>mysqli_real_escape_string($conn, $_POST['bbs_idx']),
  'placename'=>mysqli_real_escape_string($conn, $_POST['placename']),
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'comm'=>mysqli_real_escape_string($conn, $_POST['comm'])
);

$sql="
INSERT INTO bbs_comm(bbs_idx, placename, title, comm_author, comm_content) 
VALUES (
  '{$data['bbs_idx']}',
  '{$data['placename']}',
  '{$data['title']}',
  '{$_SESSION['usernickname']}',
  '{$data['comm']}'
  )
";
$result = mysqli_query($conn, $sql);

$sql2="select * from bbs_main where idx='{$data['bbs_idx']}'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
if($row2['bbs_comm'] == NULL){
  $comm_coutSql = "
  UPDATE bbs_main 
        SET 
          bbs_comm = 1
        WHERE
          idx='{$data['bbs_idx']}'
  ";
  $commCount_result = mysqli_query($conn, $comm_coutSql);
} else{
  $comm_coutSql = "
  UPDATE bbs_main 
        SET 
          bbs_comm = bbs_comm+1
        WHERE
          idx='{$data['bbs_idx']}'
  ";
  $commCount_result = mysqli_query($conn, $comm_coutSql);
}



echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      location.href = 'bbs.php?placename={$data['placename']}&title={$data['title']}&idx={$data['bbs_idx']}';
    </script>");
// print_r($data);
?>