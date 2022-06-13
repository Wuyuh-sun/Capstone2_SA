<?
include("./db_connect.php");
session_start();

$data = array(
  'jsonDataArray'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
);
// echo $data['jsonDataArray'];

$sql = "DELETE FROM faq_comm
        WHERE idx='{$data['jsonDataArray']['comm_idx']}'
        ";
$result = mysqli_query($conn, $sql);

$comm_comm_select = "
select count(*) FROM faq_comm_comm
WHERE comm_idx='{$data['jsonDataArray']['comm_idx']}'
";
$comm_comm_select_result = mysqli_query($conn, $comm_comm_select);
$row = mysqli_fetch_array($comm_comm_select_result);

$comm_comm_delete = "
DELETE FROM faq_comm_comm
WHERE comm_idx='{$data['jsonDataArray']['comm_idx']}'
";
$comm_comm_delete_result = mysqli_query($conn, $comm_comm_delete);

$comm_coutSql = "
  UPDATE faq_main 
        SET 
          bbs_comm = bbs_comm-1
        WHERE
          idx='{$data['jsonDataArray']['bbs_idx']}'
  ";
$commCount_result = mysqli_query($conn, $comm_coutSql);

$comm_coutSql2 = "
  UPDATE faq_main 
        SET 
          bbs_comm = bbs_comm-{$row['count(*)']}
        WHERE
          idx='{$data['jsonDataArray']['bbs_idx']}'
  ";
$commCount_result2 = mysqli_query($conn, $comm_coutSql2);

?>