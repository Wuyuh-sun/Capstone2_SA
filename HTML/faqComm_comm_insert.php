<?
include("./db_connect.php");
session_start();

$data = array(
  'bbs_idx'=>mysqli_real_escape_string($conn, $_POST['bbs_idx']),
  'placename'=>mysqli_real_escape_string($conn, $_POST['placename']),
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'comm_idx'=>mysqli_real_escape_string($conn, $_POST['comm_idx']),
  'comm_author'=>mysqli_real_escape_string($conn, $_POST['comm_author']),
  'comm_content'=>mysqli_real_escape_string($conn, $_POST['comm_content']),
  'comm_comm_author'=>mysqli_real_escape_string($conn, $_POST['comm_comm_author']),
  'comm_comm_content'=>mysqli_real_escape_string($conn, $_POST['comm_comm_content'])
);

// print_r($data);
$sql="
INSERT INTO faq_comm_comm(bbs_idx, placename, title, comm_idx, comm_author, comm_content, comm_comm_author, comm_comm_content) 
VALUES (
  '{$data['bbs_idx']}',
  '{$data['placename']}',
  '{$data['title']}',
  '{$data['comm_idx']}',
  '{$data['comm_author']}',
  '{$data['comm_content']}',
  '{$data['comm_comm_author']}',
  '{$data['comm_comm_content']}'
  )
";
$result = mysqli_query($conn, $sql);

$sql2="select * from faq_main where idx='{$data['bbs_idx']}'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
if($row2['bbs_comm'] == NULL){
  $comm_coutSql = "
  UPDATE faq_main 
        SET 
          bbs_comm = 1
        WHERE
          idx='{$data['bbs_idx']}'
  ";
  $commCount_result = mysqli_query($conn, $comm_coutSql);
} else{
  $comm_coutSql = "
  UPDATE faq_main 
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
      location.href = 'faq.php?placename={$data['placename']}&title={$data['title']}&idx={$data['bbs_idx']}';
    </script>");
?>