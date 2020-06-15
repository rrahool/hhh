<?php
namespace appoindar;

class SetupClass
{
    public function dbSetup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hname = $_REQUEST["hname"];
            $uname = $_REQUEST["uname"];
            $pass = $_REQUEST["pass"];
            $db_name = $_REQUEST["dbname"];

            $myfile = fopen("classes/DatabaseClass.php", "w");

            $txt = "<?php
	class Database {
		public \$hostname='".$hname."';
		public \$username='".$uname."';
		public \$password='".$pass."';
		public \$dbname='".$db_name."';
		public \$conn;

			function __construct(){
				try
 					{
 						\$this->conn = mysqli_connect(\$this->hostname,
 						\$this->username, \$this->password, \$this->dbname, 3306);
 					}

 				catch(PDOException \$e)
 					{
 						echo \$e->getmessage();
 					}
			}


} ?> ";
            //var_dump($txt) ;die;
            fwrite($myfile, $txt);
            fclose($myfile);

            echo "<script type='text/javascript'>window.location = '../registration.php'</script>";
        }
    }

    /**
     *
     */
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['uname'];
            $password = $_POST['pass'];
            $password = md5($password);

            $selectQuery = "SELECT id, fullname, role, image FROM users WHERE username='$username' AND password='$password'";
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            $qry_result = mysqli_query($dbcon->conn, $selectQuery);
            $row = mysqli_num_rows($qry_result);
            if ($row > 0) {
                $user = mysqli_fetch_array($qry_result);
                //session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                if($user['role'] == 'admin'){
                  echo "<script type='text/javascript'>window.location = 'admin-dashboard.php?id=".$user['id']."'</script>";
                } else {
                  echo "<script type='text/javascript'>window.location = 'rezavai/home.php?id=".$user['id']."'</script>";
                }

                exit();
            } else {
                echo "<script type='text/javascript'>window.location = 'login.php?error=1'</script>";
            }
        }
    }

    public function resetPassword(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $password = $_POST['pass'];
            $password2 = $_POST['confirm'];
            if ($password == $password2){
                $password = md5($password);
                $qry = "UPDATE users SET password='$password' WHERE id = $id ";
                $dbcon = new DatabaseClass();
                mysqli_query($dbcon->conn, $qry);
                $msg = "Password reset successfully.";
            } else{
                $msg = "Password reset failed.";
            }
        return $msg;
        }
    }

        public function registration()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fullName = $_POST['fname'];
                $email = $_POST['email'];
                $shortName = strtolower(str_replace(' ','_',$fullName));
                //$startDate = strtotime($_POST['startdate']);
                //$endDate = strtotime($_POST['enddate']);
                //$conflict = 1;
                //$conflict = $_POST['conflict'];
                $username = $_POST['uname'];
                $password = $_POST['pass'];
                $p_id = (isset($_POST['p_id']))?$_POST['p_id']:1;
                $password = md5($password);

                $dbcon = new DatabaseClass();

                mysqli_autocommit($dbcon->conn, FALSE);

                $insertQuery = "INSERT into `users` (username, password, fullname, shortname, email)
                                values ('$username', '$password', '$fullName', '$shortName',
                                 '$email')";

                if (mysqli_query($dbcon->conn, $insertQuery) === TRUE) {
                    $u_id = mysqli_insert_id($dbcon->conn);
                    $insertQuery1 = "INSERT into `user_details` (id) values ($u_id)";
                    mysqli_query($dbcon->conn, $insertQuery1);

                }
                if (!mysqli_commit($dbcon->conn)) { //commit transaction
                  print("Table saving failed");
                   exit();
                }
                

                //echo $insertQuery;
                //include "DatabaseClass.php";
                // $dbcon = new DatabaseClass();
                // mysqli_query($dbcon->conn, $insertQuery);
//                $last_id = mysqli_insert_id($dbcon->conn);
//                $subscriptionQuery = "INSERT into subscription (user_id, p_id) values($last_id,$p_id)";
//                mysqli_query($dbcon->conn, $subscriptionQuery);
//                if(isset($_SESSION) && $_SESSION['user']['role'] == 'admin'){
                  //what will happen?
//                } else {
//                  $_SESSION['last_id'] = $last_id;
                    echo "<script type='text/javascript'>window.location = 'login.php'</script>";
//                }

            }
        }
        
        public function activateUser(){
        	$id = $_SESSION['last_id'];
        	$updateQuery = "UPDATE users SET status= 'Active' WHERE id = ".$id;
        	$dbcon = new DatabaseClass();
                mysqli_query($dbcon->conn, $updateQuery );
        }

    public function delete()
    {
      if(isset($_GET['action']) && $_GET['action'] == 'delete') {
        $query = "DELETE FROM ".$_GET['from']."s WHERE id = ".$_GET['id'];
        //echo $query;die;
        $dbcon = new DatabaseClass();
        mysqli_query($dbcon->conn, $query);
      }
    }

    public function cal_edit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['calendar_id'];
            $name = $_POST['name'];
            $startDate = strtotime($_POST['startdate']);
            $endDate = strtotime($_POST['enddate']);
            //$conflict = 1;
            //$conflict = $_POST['conflict'];

            $insertQuery = "UPDATE `calendars` SET startdate='$startDate', enddate='$endDate', name='$name' where id=$id";
            //echo $insertQuery;
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            mysqli_query($dbcon->conn, $insertQuery);
            $user_id = $_SESSION['user_id'];

            echo "<script type='text/javascript'>window.location = 'dashboard.php?id=$user_id'</script>";
        }
    }

    protected function tableColumns($table)
    {
      $dbcon = new DatabaseClass();

      $selectQuery = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$table' and TABLE_SCHEMA = '$dbcon->dbname'";
      //$selectQuery = "SHOW COLUMNS FROM events";
      $result = mysqli_query($dbcon->conn, $selectQuery);
      $c = array();
      while($columns = mysqli_fetch_array($result)){
        $c[] = $columns['COLUMN_NAME'];
      }
      array_shift($c);
      array_pop($c);
      array_pop($c);
      $cl = implode(",", $c);

      return $cl;

    }

    public function duplicateCalendar($id){
      $dbcon = new DatabaseClass();

        $value = "calendars";
        $columns = self::tableColumns($value);
        $query = "INSERT INTO $value ($columns)  SELECT $columns FROM $value WHERE id = $id";
        mysqli_query($dbcon->conn, $query);
        $c_id = mysqli_insert_id($dbcon->conn);

        $goals = self::getGoals($id);
        foreach ($goals['id'] as $key => $value) {
          $goalQuery = "INSERT into goals(name, weeks, start_week, calendar_id, color)
                        VALUES('".$goals['name'][$key]."','".$goals['weeks'][$key]."','".$goals['start_week'][$key]."', $c_id,'".$goals['color'][$key]."')";

          mysqli_query($dbcon->conn, $goalQuery);
          $g_id = mysqli_insert_id($dbcon->conn);

          $tactics = self::getTacticsInfo($goals['id'][$key]);
          foreach ($tactics['id'] as $k => $v) {
            $tacticsQuery = "INSERT into tactics(goal_id, tactics, est_time, frequency, unit, count)
                          VALUES($g_id,'".$tactics['name'][$k]."','".$tactics['est_time'][$k]."', '".$tactics['frequency'][$k]."','".$tactics['unit'][$k]."','".$tactics['count'][$k]."')";

            mysqli_query($dbcon->conn, $tacticsQuery);
            $t_id = mysqli_insert_id($dbcon->conn);

            $dependency = self::getDependency($tactics['id'][$k]);
            $dependencyQuery = "INSERT into dependency(tactics_id, dependency, goal_id, calendar_id)
                          VALUES($t_id, $dependency, $g_id, $c_id)";
            mysqli_query($dbcon->conn, $dependencyQuery);
            $t_id = mysqli_insert_id($dbcon->conn);
          }

          $query = "SELECT * FROM events WHERE type = ".$goals['id'][$key];
          $rows = mysqli_query($dbcon->conn, $query);
          if(mysqli_num_rows($rows) > 0){
            while ($e = mysqli_fetch_array($rows)) {
              $eventQuery = "INSERT into events(courseid, date, period_from, period_to, duration, title, description, type, instructor)
                              VALUES('".$c_id."','".$e['date']."','".$e['period_from']."','".$e['period_to']."','".$e['duration']."','".$e['title']."','".$e['description']."','".$g_id."','".$e['instructor']."')";
              mysqli_query($dbcon->conn, $eventQuery);
            }
          }

          $query = "SELECT * FROM timetable_entry WHERE courseid = $id";
          $rows = mysqli_query($dbcon->conn, $query);
          if(mysqli_num_rows($rows) > 0){
            while ($e = mysqli_fetch_array($rows)) {
              $eventQuery = "INSERT into timetable_entry(courseid, date, period_from, period_to, title, description, type, instructor)
                              VALUES('".$c_id."','".$e['date']."','".$e['period_from']."','".$e['period_to']."','".$e['title']."','".$e['description']."','".$e['type']."','".$e['instructor']."')";
              mysqli_query($dbcon->conn, $eventQuery);
            }
          }

        }
        self::periodSetup($c_id);

    }

    public function deleteCalendar($id)
    {
      $deleteEvents = "DELETE from events WHERE courseid = ".$id;
      $deleteTimetable = "DELETE from timetable_entry WHERE courseid = ".$id;
      $deleteDependency = "DELETE from dependency WHERE calendar_id = ".$id;
      $deleteTactics = "DELETE from tactics WHERE goal_id in (select id from goals where calendar_id = ".$id.")";
      $deleteDependency = "DELETE from dependency WHERE calendar_id = ".$id;
      $deleteGoals = "DELETE from goals WHERE calendar_id = ".$id;
      $deleteCalendar = "DELETE from calendars WHERE id = ".$id;

      $dbcon = new DatabaseClass();
      mysqli_query($dbcon->conn, $deleteEvents);
      mysqli_query($dbcon->conn, $deleteTimetable);
      mysqli_query($dbcon->conn, $deleteDependency);
      mysqli_query($dbcon->conn, $deleteTactics);
      mysqli_query($dbcon->conn, $deleteGoals);
      mysqli_query($dbcon->conn, $deleteCalendar);

    }

    public function cal_registration()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $user_id = $_SESSION['user_id'];
            $name = $_POST['name'];
            $startDate = strtotime($_POST['startdate']);
            $endDate = strtotime($_POST['enddate']);
            //$conflict = 1;
            //$conflict = $_POST['conflict'];

            $insertQuery = "INSERT into `calendars` (user_id, startdate, enddate, name)
                            values ('$user_id', '$startDate', '$endDate', '$name')";
            //echo $insertQuery;
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            mysqli_query($dbcon->conn, $insertQuery);
            $last_id = mysqli_insert_id($dbcon->conn);

            echo "<script type='text/javascript'>window.location = 'goal_setup.php?id=$last_id'</script>";
        }
    }

    public function checkAdmin()
    {
      if(isset($_SESSION['user_id']) && $_SESSION['user']['role'] == 'admin'){
        return true;
      }
      else{
        echo "<script type='text/javascript'>window.location = 'login.php?error=1'</script>";
      }
    }

    public function checkUser($id)
    {
      if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id){
        return true;
      }
      else{
        echo "<script type='text/javascript'>window.location = 'login.php?error=1'</script>";
      }
    }

    public function periodSetup($courseid)
    {
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $active = 1;
            $period = 1;
            $values = array();
            $fields = "(courseid, period, active, start_time, end_time, display)";
            $time = 9;
            for ($i=1; $i<=12; $i++) {
                $heading = "To do #".$i;
                $stime = ($time > 9) ? $time : "0".$time;
                $start = $stime."00";
                $time++;
                $end = $time."00";
                $values[] = "('$courseid', '$period', '$active', '$start', '$end', '$heading')";
                $period++;
            }
            $value = implode(",", $values);

            $insertQuery = "INSERT into `timetable_slot` $fields values $value";
            //echo $insertQuery;die;
            $dbcon = new DatabaseClass();
            $deleteQuery = "DELETE FROM `timetable_slot` WHERE `courseid`=$courseid";
            mysqli_query($dbcon->conn, $deleteQuery);
            mysqli_query($dbcon->conn, $insertQuery);
        // }
    }

    public function goalDelete($id,$calendar_id)
    {
      $deleteQuery = "DELETE FROM goals WHERE id = $id AND calendar_id=$calendar_id";
      $dbcon = new DatabaseClass();
      mysqli_query($dbcon->conn, $deleteQuery);

      $deleteQuery = "DELETE FROM `tactics` WHERE goal_id=$id";
      mysqli_query($dbcon->conn, $deleteQuery);

      $msg = "The goal is deleted successfully";
      echo "<script type='text/javascript'>window.location = 'goal_setup.php?id=$calendar_id&msg=$msg'</script>";
    }

    public function tacticsSetup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $goal_id = $_POST['id'];
            $active = 1;
            $calendar_id = $_POST['calendar_id'];
            $period = 1;
            $values = array();
            $fields = "(goal_id, tactics, est_time, frequency, unit, count)";
            foreach ($_POST['tactics'] as $k => $v) {
                $tactics = htmlentities($v,ENT_QUOTES);
                $est_time = $_POST['estimated_time'][$k]." ".$_POST['time_unit'][$k];
                $frequency = $_POST['frequency'][$k];
                $unit = $_POST['unit'][$k];
                $count = $_POST['count'][$k];
                $values[] = "('$goal_id', '$tactics', '$est_time', '$frequency', '$unit', '$count')";
                $period++;
            }
            $value = implode(",", $values);

            $insertQuery = "INSERT into `tactics` $fields values $value";
            //echo $insertQuery;die;
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            // Delete previosly stored tactics to edit
            $deleteQuery = "DELETE FROM `tactics` WHERE goal_id=$goal_id";
            // Update goal posix_times
            $updateQuery = "UPDATE goals SET goal_time = ".$_POST['goal_time']." WHERE id=$goal_id";
            
            mysqli_query($dbcon->conn, $deleteQuery);

            mysqli_query($dbcon->conn, $insertQuery);

            mysqli_query($dbcon->conn, $updateQuery);

            echo "<script type='text/javascript'>window.location = 'dependency_setup.php?id=$calendar_id&goal=$goal_id'</script>";
        }
    }

    public function calculateAvailableTime($startWeek, $weekNumber, $calendar_id)
    {
      $calendar = self::getCalendarInfo($calendar_id);
      $start = $calendar['startdate'];
      $startWeek--;
      $first_day = date("Y-m-d", strtotime(date("Y-m-d",$start) ." +".$startWeek." week"));
      //$first_day = date("Y-m-d",strtotime("+1 week"));
      //echo $first_day;die;
      $day_after_last_day = date("Y-m-d", strtotime($first_day." +".$weekNumber++." week"));
      $last_day = date("Y-m-d", strtotime($day_after_last_day." -1 day"));

      $total_hours_sql = "SELECT SUM(title) as total_hour FROM `timetable_entry` WHERE date BETWEEN '$first_day' and '$last_day' AND courseid=$calendar_id";
      //echo $total_hours_sql;
      ////include "DatabaseClass.php";
      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $total_hours_sql);
      $total_hour = mysqli_fetch_assoc($result);
      return $total_hour['total_hour']*60;
    }

    public function dependencySetup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $active = 1;
            $calendar_id = $_POST['calendar_id'];
            $goal_id = $_POST['goal_id'];
            $period = 1;
            $values = array();
            $fields = "(tactics_id, dependency, goal_id, calendar_id)";
            foreach ($_POST['tactics_id'] as $k => $v) {
                $tactics_id = $v;
                $dependency = $_POST['dependency'][$k];
                $values[] = "('$tactics_id', '$dependency', '$goal_id', '$calendar_id')";
                $period++;
            }
            $value = implode(",", $values);

            $insertQuery = "INSERT into `dependency` $fields values $value";
            //echo $insertQuery;die;
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            // Delete previosly stored tactics to edit
            $deleteQuery = "DELETE FROM `dependency` WHERE goal_id=$goal_id";
            mysqli_query($dbcon->conn, $deleteQuery);

            mysqli_query($dbcon->conn, $insertQuery);

            echo "<script type='text/javascript'>window.location = 'goal_setup.php?id=$calendar_id'</script>";
        }
    }

    public function scheduleSetup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $calendar_id = $_POST['calendar_id'];
            $sun = $_POST['Sun'];
            $mon = $_POST['Mon'];
            $tue = $_POST['Tue'];
            $wed = $_POST['Wed'];
            $thu = $_POST['Thu'];
            $fri = $_POST['Fri'];
            $sat = $_POST['Sat'];

            $sub = $_POST['sub'];

            $calendar = self::getCalendarInfo($calendar_id);
            $start = $calendar['startdate'];
            $end = $calendar['enddate'];
            $j=1;

            $dbcon = new DatabaseClass();
            // First delete existing setup
            $deleteQuery = "DELETE from `timetable_entry` WHERE `courseid`=$calendar_id";
            mysqli_query($dbcon->conn, $deleteQuery);

            for ($i = $start; $i < $end; $i = $i+(24*3600)) {
                $day = date("D", $i);
                $date = date("Y-m-d", $i);
                $title = $_POST[$day];

                $insertQuery = "INSERT INTO `timetable_entry` (`courseid`, `date`, `period_from`, `period_to`, `title`, `description`, `type`, `instructor`)
                VALUES ('$calendar_id', '$date', '1', '1', '$title', 'something', 'office', 'Nobody');";

                //$updateQuery = "UPDATE `timetable_entry` SET `title`='$title' WHERE `date`='$date' ";
                mysqli_query($dbcon->conn, $insertQuery);
                //($sub == 'submit') ? mysqli_query($dbcon->conn, $insertQuery): mysqli_query($dbcon->conn, $updateQuery);
            }

            self::periodSetup($calendar_id);
            self::activitySetup($calendar_id);

            echo "<script type='text/javascript'>window.location = 'timetable.php?id=$calendar_id'</script>";
        }
    }

    public function totalWeekTime($calendar_id, $week_start, $week_end){
      $total_hours_sql = "SELECT SUM(title) as total_hour FROM `timetable_entry` WHERE date BETWEEN '$week_start' and '$week_end' AND courseid=$calendar_id";


      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $total_hours_sql);
      $total_hour = mysqli_fetch_assoc($result);
      return $total_hour['total_hour']*60;

    }

    public function totalScheduledTime($calendar_id, $week_start, $week_end){
      $total_hours_sql = "SELECT SUM(duration) as total_hour FROM `events` WHERE date BETWEEN '$week_start' and '$week_end' AND courseid=$calendar_id";


      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $total_hours_sql);
      $total_hour = mysqli_fetch_assoc($result);
      return $total_hour['total_hour'];

    }

    public function dailySpareTime($calendar_id, $i){
      $i_date = date('Y-m-d', $i);
      $sql = "SELECT (title*60) - (SELECT SUM(duration) FROM `events` WHERE date = '$i_date' AND courseid = $calendar_id) as spare_time FROM `timetable_entry` WHERE date = '$i_date' AND courseid = $calendar_id";

      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $sql);
      $total_hour = mysqli_fetch_assoc($result);
      return $total_hour['spare_time'];
    }

    public function maxPeriod($calendar_id, $i){
      $i_date = date('Y-m-d', $i);
      $sql = "SELECT max(period_to) as period FROM `events` WHERE date = '$i_date' AND courseid = $calendar_id";

      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $sql);
      $total_hour = mysqli_fetch_assoc($result);
      return $total_hour['period'];
    }

    public function eventSetup($calendar_id, $date, $time, $title, $period, $goal)
    {
        $dbcon = new DatabaseClass();

        $insertQuery = "INSERT INTO `events` (`courseid`,`date`,`period_from`,`period_to`,`duration`,`title`,`description`,`type`,`instructor`)
        VALUES ('$calendar_id', '$date', '$period', '$period', '$time', '$title', 'something', '$goal', 'Nobody');";
        //echo $insertQuery;
        mysqli_query($dbcon->conn, $insertQuery);
    }

    public function removeEvents($calendar_id)
    {
      $deleteQuery = "DELETE from `events` WHERE `courseid`=$calendar_id";

      $dbcon = new DatabaseClass();
      mysqli_query($dbcon->conn, $deleteQuery);
    }

    public function goalEdit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $goal_id = $_POST['id'];
            $calendar_id = $_POST['calendar_id'];
            $name = $_POST['goal'];
            $weeks = $_POST['weeks'];
            $start = $_POST['start'];
            $color = $_POST['color'];
            $set = " name='$name', weeks='$weeks', start_week='$start', color='$color' ";

            $insertQuery = "UPDATE `goals` SET $set where id=$goal_id";
            //echo $insertQuery;die;
            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            mysqli_query($dbcon->conn, $insertQuery);
            $goal_id = mysqli_insert_id($dbcon->conn);

            echo "<script type='text/javascript'>window.location = 'goal_setup.php?id=$calendar_id'</script>";
        }
    }

    public function goalSetup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $calendar_id = $_POST['id'];
            $name = $_POST['goal'];
            $weeks = $_POST['weeks'];
            $start = $_POST['start'];
            $color = $_POST['color'];
            $values = "('$name', '$weeks', '$start', '$calendar_id', '$color')";

            $goal_id = self::saveGoal($values);

            echo "<script type='text/javascript'>window.location = 'tactics_setup.php?id=$calendar_id&goal=$goal_id'</script>";
        }
    }

    public function saveGoal($values){

      $fields = "(name, weeks, start_week, calendar_id, color)";

      $insertQuery = "INSERT into `goals` $fields values $values";
      //echo $insertQuery;die;
      //include "DatabaseClass.php";
      $dbcon = new DatabaseClass();
      mysqli_query($dbcon->conn, $insertQuery);
      $goal_id = mysqli_insert_id($dbcon->conn);

      return $goal_id;
    }

    public function deleteBuffer($calendar_id)
    {
      $deleteQuery = "DELETE from goals WHERE name = 'Buffer' and calendar_id=$calendar_id ";
      $dbcon = new DatabaseClass();
      mysqli_query($dbcon->conn, $deleteQuery);
    }

    public function checkGoal($name, $calendar_id)
    {
      $selectQuery = "SELECT id from goals where name='$name' and calendar_id=$calendar_id";
      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $selectQuery);
      if (mysqli_num_rows($result) > 0) {
          $r = mysqli_fetch_assoc($result);
          return $r['id'];
      }
      return 0;
    }

        public function calendars($id)
        {
            $qry = "SELECT * FROM `calendars` WHERE user_id = ".$id;

            //include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            $result = mysqli_query($dbcon->conn, $qry);
            if (mysqli_num_rows($result) > 0) {
              $calendars = array();
                while($c = mysqli_fetch_array($result)){
                  $calendars['name'][] = $c['name'];
                  $calendars['id'][] = $c['id'];
                }
                return $calendars;
            }
        }

        public function getCalendarInfo($id)
        {
            $qry = "SELECT * FROM `calendars` WHERE id = ".$id;

            ////include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            $result = mysqli_query($dbcon->conn, $qry);
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_assoc($result);
            }
        }

        public function getAllCalendarInfo()
        {
            $qry = "SELECT * FROM `calendars`";

            ////include "DatabaseClass.php";
            $dbcon = new DatabaseClass();
            $result = mysqli_query($dbcon->conn, $qry);
            if (mysqli_num_rows($result) > 0) {
                return mysqli_num_rows($result);
            }
        }

    public function getGoalInfo($id)
    {
        $qry = "SELECT * FROM `goals` WHERE id = ".$id;

        ////include "DatabaseClass.php";
        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    public function getUserInfo($id)
    {
        $qry = "SELECT * FROM `users` WHERE id = ".$id;

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    public function getGoals($id)
    {
        $qry = "SELECT * FROM `goals` WHERE calendar_id = ".$id;

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            $goal_names = array();
            while ($goals = mysqli_fetch_array($result)) {
                $goal_names['name'][] = $goals['name'];
                $goal_names['id'][] = $goals['id'];
                $goal_names['weeks'][] = $goals['weeks'];
                $goal_names['start_week'][] = $goals['start_week'];
                $goal_names['color'][] = $goals['color'];
            }
            return $goal_names;
        }
    }

    public function getDependency($id)
    {
      $qry = "SELECT dependency FROM dependency WHERE tactics_id=$id";

      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      $getResult =  mysqli_fetch_assoc($result);
      return $getResult['dependency'];
    }

    // Get the required number of event occurance
    public function dependencyCount($id)
    {
      $qry = "SELECT count FROM tactics WHERE id=$id";

      $dbcon = new DatabaseClass();
      $result = mysqli_query($dbcon->conn, $qry);
      $getResult =  mysqli_fetch_assoc($result);
      return $getResult['count'];
    }

    public function getTacticsInfo($id)
    {
        $qry = "SELECT * FROM `tactics` WHERE goal_id = ".$id;

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            $tactics_time = array();
            while ($tactics = mysqli_fetch_array($result)) {
                $tactics_time['id'][] = $tactics['id'];
                $tactics_time['name'][] = $tactics['tactics'];
                $tactics_time['est_time'][] = $tactics['est_time'];
                $tactics_time['frequency'][] = $tactics['frequency'];
                $tactics_time['unit'][] = $tactics['unit'];
                $tactics_time['count'][] = $tactics['count'];
            }
            return $tactics_time;
        } else {
            return 0;
        }
    }

    public function getMaxTacticsTime($id)
    {
        $qry = "SELECT * FROM `tactics` WHERE goal_id in (SELECT id from goals WHERE calendar_id = $id)";

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            $tactics_time = array();
            while ($tactics = mysqli_fetch_array($result)) {
                $tactics_time['id'][] = $tactics['id'];
                $tactics_time['name'][] = $tactics['tactics'];
                $exp_estTime = explode(" ",$tactics['est_time']);
                $tactics_time['est_amount'][] = $exp_estTime[0];
                $tactics_time['est_unit'][] = $exp_estTime[1];
                $tactics_time['minutes'][] = ($exp_estTime[1] == 'Minutes') ? $exp_estTime[0] : $exp_estTime[0]*60;
                $tactics_time['est_time'][] = $tactics['est_time'];
                $tactics_time['frequency'][] = $tactics['frequency'];
                $tactics_time['unit'][] = $tactics['unit'];
                $tactics_time['count'][] = $tactics['count'];
            }
            $maxs = array_keys($tactics_time['minutes'], max($tactics_time['minutes']));
            $maxs = $maxs[0];
            //print_r($maxs);
            if ($tactics_time['est_unit'][$maxs] == 'Minutes') {
              if ($tactics_time['unit'][$maxs] == 'Day') {
                $req = $tactics_time['frequency'][$maxs]*$tactics_time['est_amount'][$maxs];
                return "You have to have minimum $req Minutes in every day";
              } elseif ($tactics_time['unit'][$maxs] == 'Week') {
                return "You have to have minimum ".$tactics_time['est_amount'][$maxs]." Minutes in ".$tactics_time['frequency'][$maxs]." days";
              } else {
                return "You have to have minimum ".$tactics_time['est_amount'][$maxs]." Minutes at least once.";
              }
            } else {
              if ($tactics_time['unit'][$maxs] == 'Day') {
                $req = $tactics_time['frequency'][$maxs]*$tactics_time['est_amount'][$maxs];
                return "You have to have minimum $req Hours in every day";
              } elseif ($tactics_time['unit'][$maxs] == 'Week') {
                return "You have to have minimum ".$tactics_time['est_amount'][$maxs]." Hours in ".$tactics_time['frequency'][$maxs]." days";
              } else {
                return "You have to have minimum ".$tactics_time['est_amount'][$maxs]." Hours at least once.";
              }
            }
        } else {
            return 0;
        }
    }

    public function getScheduleInfo($calendar_id)
    {
        $qry = "SELECT sum(title) as total_time FROM `timetable_entry` WHERE courseid = ".$calendar_id;

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        return  mysqli_fetch_assoc($result);
    }

    public function allotedTime($this_date, $calendar_id)
    {
        $qry = "SELECT title FROM `timetable_entry` WHERE date = '$this_date' AND courseid = '$calendar_id'";
        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        return  mysqli_fetch_assoc($result);
    }

    public function getScheduleDetails($calendar_id)
    {
        $qry = "SELECT title FROM `timetable_entry` WHERE courseid = ".$calendar_id." limit 0,7";

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            $tactics_time = array();
            while ($entry = mysqli_fetch_array($result)) {
                $tactics_time['title'][] = $entry['title'];
            }
            return $tactics_time;
        } else {
            return 0;
        }
    }

    public function getTactics($id)
    {
        $qry = "SELECT * FROM `tactics` WHERE goal_id = ".$id;

        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn, $qry);
        if (mysqli_num_rows($result) > 0) {
            $goal_names = array();
            while ($goals = mysqli_fetch_array($result)) {
                $goal_names['id'][] = $goals['id'];
                $goal_names['name'][] = $goals['tactics'];
            }
            return $goal_names;
        }
    }

    public function activitySetup($courseid)
    {
            $fields = "(courseid, activitytype, activitycolor)";
            $values = "('$courseid', 'office', '#880000')";

            $insertQuery = "INSERT into `timetable_type` $fields values $values";
            //echo $insertQuery;die;
            $dbcon = new DatabaseClass();
            $deleteQuery = "DELETE FROM `timetable_type` WHERE `courseid`=$courseid";
            mysqli_query($dbcon->conn, $deleteQuery);
            mysqli_query($dbcon->conn, $insertQuery);
    }

    public function send_password_reset_link(){
        $condition = "";

        if(!empty($_POST["email"])) {
            if(!empty($condition)) {
                $condition = " and ";
            }
            $condition = " email = '" . $_POST["email"] . "'";
        }

        if(!empty($condition)) {
            $condition = " where " . $condition;
        }

        $sql = "Select * from users " . $condition;
        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn,$sql);
        $user = mysqli_fetch_array($result);

        if(!empty($user)) {
            require_once("forgot-password-recovery-mail.php");
        } else {
            $error_message = 'No User Found';
        }
    }

    public function getIdBySalt($salt, $email){
        $condition = "";

        if(!empty($email)) {
            if(!empty($condition)) {
                $condition = " and ";
            }
            $condition = " email = '" . $email . "'";
        }
        if(!empty($salt)) {
            if(!empty($condition)) {
                $condition = " and ";
            }
            $condition = " password = '" . $salt . "'";
        }

        if(!empty($condition)) {
            $condition = " where " . $condition;
        }
        $sql = "Select * from users " . $condition;
        $dbcon = new DatabaseClass();
        $result = mysqli_query($dbcon->conn,$sql);
        $user = mysqli_fetch_array($result);
        return $user;
    }
}
