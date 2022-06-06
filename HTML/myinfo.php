<?
include("./db_connect.php");
session_start();
if(isset($_SESSION["useremail"])){
  $useremail = $_SESSION["useremail"];
} else {
  $useremail = "";
}
if(isset($_SESSION["usernickname"])){
  $usernickname = $_SESSION["usernickname"];
} else {
  $usernickname = "";
}
if(isset($_SESSION["userpassword"])){
  $userpassword = $_SESSION["userpassword"];
} else {
  $userpassword = "";
}
if(!$_SESSION["useremail"]){
  echo(" 
        <script> 
          window.alert('로그인 후 이용해주세요');
          location.href = 'index.php'; 
        </script> 
      ");
}

if($_SESSION["user_grade"] == "root"){
  include("./header_admin.php");
}
if($_SESSION["user_grade"] == NULL){
  include("./header.php");
}
$sql = "select * from userinfo where email='{$_SESSION["useremail"]}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// print_r($row);
if($row['user_profileImg'] ==''){
  $row['user_profileImg'] = 'user.png';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/header.css">
  <link rel="stylesheet" href="../CSS/myinfo.css">
  <title>Document</title>
</head>

<body>
  <?=$header?>
  <!-- 내 정보 -->
  <form action="myinfo_update.php" name="myinfo_update" method="POST" enctype='multipart/form-data'>
    <div class="windowBlack2" id="windowBlack2" onclick="profileUpdate_cancel()"></div>
    <div class="imgClickForm" id='imgClickForm'>
      <label for="profileImg">프로필 사진 변경</label>
      <input type="file" name='profileImgFile' id='profileImg' onchange='profileImgFileSubmit()'>
      <input type="button" class="profileImg_delete" value="프로필 사진 삭제" onclick="return profileUpdate_delete(this.form)">
      <input type="button" class="profileImg_cancel" value="취소" onclick="profileUpdate_cancel()">
      <!-- <input type="submit" value="oo"> -->
    </div>
    <img src="../img/userprofile/<?=$row['user_profileImg']?>" alt="profile_image" class="profile_image" id='profile_image' onclick='profileUpdate()'>
    <input type="text" name="nickname" class="nicknameEdit" placeholder="변경할 닉네임을 입력해주세요" maxlength="20"
    onkeyup="if(window.event.keyCode==13){check_input()}" value=<?=$usernickname?> 
    >
    <div class="id_pw_email_Form">
      <!-- 
      <label for="idEdit" class="idEdit_label">ID</label>
      <input type="text" name="idEdit" class="idEdit" placeholder="변경할 ID를 입력해주세요" value="root" maxlength="20"> -->
      <label for="emailEdit" class="emailEdit_label">e-mail</label>
      <input type="text" name="email" class="emailEdit" placeholder="변경할 이메일을 입력해주세요" maxlength="20"
      onkeyup="if(window.event.keyCode==13){check_input()}" value=<?=$useremail?> readonly>
      <label for="pwEdit" class="pwEdit_label">PASSWORD</label>
      <input type="text" name="pw" class="pwEdit" placeholder="변경할 비밀번호를 입력해주세요" minlength="6" maxlength="20"
      onkeyup="if(window.event.keyCode==13){check_input()}" value=<?=$userpassword?> >
      <p>- 영문, 숫자, 특수문자를 섞어 6~20자 이내로 만드십시오.</p>
      <p>- 공백은 사용할 수 없습니다.</p>
      <input type="text" name="pw_check" class="pw_Reinput" placeholder="변경할 비밀번호를 재입력해주세요" minlength="6" maxlength="20" onkeyup="if(window.event.keyCode==13){check_input()}">
    </div>
    <a href="#" class="editBtn" onclick="check_input()">변경하기</a>
  </form>


  <script src="../JS/menu.js"></script>
  <script src="../JS/myinfo.js"></script>
  <script src="../JS/userProfile.js"></script>

</body>

</html>