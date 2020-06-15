<?php
namespace appoindar;

class UserClass
{
  public function SelectAllUsers()
  {
    $query = "SELECT * FROM users WHERE role = 'user' ";
    $dbcon = new DatabaseClass();
    $result = mysqli_query($dbcon->conn, $query);
    if (mysqli_num_rows($result)) {
      $users = array();
      $k = 0;
      while($u = mysqli_fetch_array($result)){
        $k++;
        $users[$k]['fullname'] = $u['fullname'];
        $users[$k]['id'] = $u['id'];
        $users[$k]['status'] = $u['status'];
        $users[$k]['email'] = $u['email'];
      }
      return $users;
    }
    return 0;
  }

  public function subscribedPackage($last_id)
  {
    $qry = "SELECT p_id FROM subscription WHERE user_id = $last_id AND status = 0";

    $dbcon = new DatabaseClass();
    $result = mysqli_query($dbcon->conn, $qry);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
  }

  public function userUpdate(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $dbcon = new DatabaseClass();

      $set = array();
      $set[] = (isset($_POST['fname']) && $_POST['fname'] != '') ? "fullname = '".$_POST['fname']."'":"";
      $set[] = (isset($_POST['email']) && $_POST['email'] != '') ? "email = '".$_POST['email']."'":"";
      $set[] = (isset($_POST['status']) && $_POST['status'] != '') ? "status = '".$_POST['status']."'":"";
      $set = array_filter($set, function($value) { return $value !== ''; });
      $sets = implode(",",$set);

      if (isset($_POST['password']) && $_POST['password'] != '' && $_POST['password'] == $_POST['newPassword']) {
        $old_password = md5($_POST['oldPassword']);
        $check_old_password = "SELECT conflict FROM users WHERE id = ".$_SESSION['user_id']." AND password = '".$old_password."'";
        //echo $check_old_password;
        $result = mysqli_query($dbcon->conn, $check_old_password);
        if(mysqli_num_rows($result) > 0){
          $sets = "password = '".md5($_POST['password'])."'";
        }
      }

      //var_dump($set);die;

      if($sets != ''){
        $updateUserQry = "UPDATE users SET ".$sets." WHERE id = ".$_GET['id'];
        //echo $updateUserQry;die;
        $result = mysqli_query($dbcon->conn, $updateUserQry);
      }
        if (isset($_FILES['image'])){
            $updateUserQry = "UPDATE users SET ".self::imageUpload('image')." WHERE id = ".$_GET['id'];
            $result = mysqli_query($dbcon->conn, $updateUserQry);
        }
    }
  }

  public function imageUpload($name){
      $target_dir = "uploads/";
      $file_name = $_FILES[$name]["name"];
      $target_file = $target_dir . basename($_FILES[$name]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      //if(isset($_POST["submit"])) {
          // $check = getimagesize($_FILES[$name]["tmp_name"]);
          // if($check !== false) {
          //     $uploadOk = 1;
          // } else {
          //     echo "File is not an image.";
          //     $uploadOk = 0;
          // }
      //}
      // Check if file already exists
      // if (file_exists($target_file)) {
      //     echo "Sorry, file already exists.";
      //     $uploadOk = 0;
      // }
      // Check file size
      // if ($_FILES[$name]["size"] > 500000) {
      //     echo "Sorry, your file is too large.";
      //     $uploadOk = 0;
      // }
      // Allow certain file formats
      // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      // && $imageFileType != "gif" ) {
      //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      //     $uploadOk = 0;
      // }
      // Check if $uploadOk is set to 0 by an error
      // if ($uploadOk == 0) {
      //     echo "Sorry, your file was not uploaded.";
      // // if everything is ok, try to upload file
      // } else {
          if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
            $_SESSION['user']['image'] = $file_name;
              return $name." = '".$file_name."'";
          // } else {
          //     echo "Sorry, there was an error uploading your file.";die;
          }
      // }

  }

  public function getUserInfoForAdmin($id)
  {
      $qry = "SELECT users.* FROM `users`
      WHERE users.id = ".$id;

      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      if (mysqli_num_rows($result) > 0) {
          return mysqli_fetch_assoc($result);
      }
  }

  public function setting(){
      $qry = "SELECT * FROM settings";
      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      $settings = array();
      if (mysqli_num_rows($result) > 0) {
          while($d = mysqli_fetch_array($result)){
              $settings[$d['field_name']] = $d['field_value'];
          }
      }
      return $settings;
  }

  public function contentSetting(){
      $qry = "SELECT * FROM content_setting";
      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      $settings = array();
      if (mysqli_num_rows($result) > 0) {
          while($d = mysqli_fetch_array($result)){
              $settings[$d['field_name']] = $d['field_value'];
          }
      }
      return $settings;
  }

    public function settingUpdate(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
            $allowedTags.='<li><ol><ul><span><div><br><ins><del>';
            $dbcon = new DatabaseClass();
            $qryInit = "UPDATE settings SET ";
            foreach ($_POST as $k=>$v):
                $v = strip_tags(stripslashes($v),$allowedTags);
                $set = (isset($_POST[$k]) && $_POST[$k] != '') ? $qryInit."field_value = '".$v."' WHERE field_name = '".$k."' ":"";
                if($set != ""){
                    $result = mysqli_multi_query($dbcon->conn, $set);
                }
            endforeach;

            //var_dump($set);die;

            if (isset($_FILES['image']) && $_FILES['image']["name"] != ""){
                $imageUpdate = self::imageUpload('image');
                $imageUpdateStrArr = explode('=',$imageUpdate);
                $imageUpdateStrArr[0] = 'field_value';
                $imageUpdate = implode('=',$imageUpdateStrArr);
                $updateUserQry = "UPDATE settings SET ".$imageUpdate." WHERE field_name = 'image' ";
                //echo $updateUserQry;die;
                $result = mysqli_query($dbcon->conn, $updateUserQry);
                if(!$result){
                    echo mysqli_errno($dbcon->conn);die;
                }
            }
        }
    }

    public function contentSettingUpdate(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dbcon = new DatabaseClass();
            $qryInit = "UPDATE content_settings SET ";
            foreach ($_POST as $k=>$v):
                $set = (isset($_POST[$k]) && $_POST[$k] != '') ? $qryInit."field_value = '".$v."' WHERE field_name = '".$k."' ":"";
                if($set != ""){
                    $result = mysqli_multi_query($dbcon->conn, $set);
                }
            endforeach;
        }
    }

  public function getUserInfo($id)
  {
      //$qry = "SELECT users.*, packages.name as package_name, packages.rate, packages.features, packages.unit, packages.frequency
      $qry = "SELECT users.* FROM `users` WHERE users.id = ".$id;
//      JOIN `subscription` ON users.id = subscription.user_id
//      JOIN `packages` ON subscription.p_id = packages.id


      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      if (mysqli_num_rows($result) > 0) {
          return mysqli_fetch_assoc($result);
      }
  }

}
