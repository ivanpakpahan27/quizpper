<?php
include('check.php');
//Inserting Summary Result Here
if (isset($_SESSION['totalScore'])) {
    $totalScore = $_SESSION['totalScore'];
} else {
    $totalScore = 0;
}
//To get student id from student username
$tbl_name = "tbl_student";
$username = $_SESSION['student_username'];
$student_id = $obj->get_student_id($tbl_name, $username, $conn);
//to add sesult summary to the database
$added_date = date('Y-m-d');
$tbl_name2 = "tbl_result_summary";
$data = "student_id='$student_id',
                    marks='$totalScore',
                    added_date='$added_date'
                    ";
$query = $obj->insert_data($tbl_name2, $data);
$res = $obj->execute_query($conn, $query);
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="welcome">
            <?php
            if (isset($_SESSION['time_complete'])) {
                echo $_SESSION['time_complete'];
            }
            ?>
            You have successfully completed the test. Thank You.<br />
            <?php
            $tbl_name = 'tbl_student';
            $username = $_SESSION['student_username'];
            //Get Student ID from username
            $student_id = $obj->get_student_id($tbl_name, $username, $conn);
            //Getting Summary Result from the database
            $tbl_name3 = "tbl_result_summary";
            $where3 = "student_id=$student_id ORDER BY summary_id DESC LIMIT 1";
            $query = $obj->select_data($tbl_name3, $where3);
            $res = $obj->execute_query($conn, $query);
            $row = $obj->fetch_data($res);
            $marks = $row['marks'];
            $added_date = date('Y-m-d');

            //Calculate Marks for different subjects
            $obtainedMarks = $_SESSION['totalScore'];
            $full_marks = $_SESSION['full_marks'];
            $obtainedPercent = ($obtainedMarks / $full_marks) * 100;
            //Get Student ID
            //Get Subject ID from Student ID then Show full marks based on the subject and obtained percentage
            if ($_SESSION['subjectName'] == 'GRE') {
                $marksShown = 260 + round($obtainedPercent * 0.8);
            } elseif ($_SESSION['subjectName'] == 'GMAT') {
                $marksShown = 200 + round($obtainedPercent * 6);
            } else {
                $marksShown = $obtainedMarks;
            }

            $_SESSION['student_id'] = $student_id;
            //Round Off Marks
            $lastDigit = substr($marksShown, -1);
            if ($lastDigit < 5) {
                $realMark = $marksShown - $lastDigit;
            } else {
                $digitToAdd = 10 - $lastDigit;
                $realMark = $marksShown + $digitToAdd;
            }
            ?>
            You got <h2><?php echo $realMark; ?></h2>

            <a href="<?php echo SITEURL; ?>index.php?page=detail_result">
                <button type="button" class="btn-exit">
                    View Result
                </button>
            </a>

            <a href="<?php echo SITEURL; ?>index.php?page=logout">
                <button type="button" class="btn-exit">&nbsp; Log Out &nbsp;</button>
            </a>
        </div>
    </div>
</div>
<!--Body Ends Here-->