<?
include("./db_connect.php");
session_start();

$data = array(
  'jsonDataArray'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
);
// echo $data['jsonDataArray'];

$sql = "DELETE FROM bbs_comm_comm
        WHERE idx='{$data['jsonDataArray']['comm_comm_idx']}'
        ";
$result = mysqli_query($conn, $sql);


$comm_coutSql = "
  UPDATE bbs_main 
        SET 
          bbs_comm = bbs_comm-1
        WHERE
          idx='{$data['jsonDataArray']['bbs_idx']}'
  ";
$commCount_result = mysqli_query($conn, $comm_coutSql);

?>