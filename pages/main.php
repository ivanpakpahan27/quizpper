<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

switch ($page) {
    case "home": {
            include('home.php');
        }
        break;

    case "question": {
            include('question.php');
        }
        break;

    case "login": {
            include('login.php');
        }
        break;

    case "endSession": {
            include('endSession.php');
        }
        break;

    case "schedule": {
            include('schedule.php');
        }
        break;

    case "detail_result": {
            include('detail_result.php');
        }
        break;

    case "logout": {
            $tbl_name = "tbl_student";
            $username = $_SESSION['student_username'];
            $student_id = $obj->get_student_id($tbl_name, $username, $conn);
            $res = true;
            if ($res == true) {
                //Setting Student Is_Active Mode to No
                $tbl_name3 = "tbl_student";
                $data3 = "is_active='no'";
                $where3 = "student_id='$student_id'";
                $query3 = $obj->update_data($tbl_name3, $data3, $where3);
                $res3 = $obj->execute_query($conn, $query3);
                if ($res3 === true) {
                    session_destroy();
                    header('location:' . SITEURL . 'index.php?page=login');
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        }
        break;

    default: {
            include('home.php');
        }
        break;
}
