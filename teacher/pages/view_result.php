<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">

            <?php
            if (isset($_GET['student_id'])) {
                $student_id = $_GET['student_id'];
                $full_name = $obj->get_fullname('tbl_student', $student_id, $conn);
                echo "<h2>" . $full_name . "'s Result</h2>";
            } else {
                header('location:' . SITEURL . 'teacher/index.php?page=dashboard');
            }
            if (isset($_GET['added_date'])) {
                $added_date = $_GET['added_date'];
            } else {
                header('location:' . SITEURL . 'teacher/index.php?page=dashboard');
            }
            //Now Getting VAlues Based on aded date and student id
            $tbl_name = "tbl_result";
            $where = "student_id='$student_id' && added_date='$added_date'";
            $query = $obj->select_data($tbl_name, $where);
            $res = $obj->execute_query($conn, $query);
            $sn = 1;
            while ($row = $obj->fetch_data($res)) {
                $student_id = $row['student_id'];
                $question_id = $row['question_id'];
                $student_answer = $row['student_answer'];
                $right_answer = $row['right_answer'];

                $added_date = $row['added_date'];
                //Get all the question and answers detail
                $tbl_name2 = "tbl_question";
                $where2 = "question_id='$question_id'";
                $query2 = $obj->select_data($tbl_name2, $where2);
                $res2 = $obj->execute_query($conn, $query2);
                $row2 = $obj->fetch_data($res2);
                // $count_rows = $obj->num_rows($res2);
                // isset($cOTLdata['char_data']);

                if (isset($row2['question']) > 0) {
                    $question = $row2['question'];
                } else {
                    $question = 0;
                }

                if (isset($row2['first_answer']) > 0) {
                    $first_answer = $row2['first_answer'];
                } else {
                    $first_answer = 0;
                }

                if (isset($row2['second_answer']) > 0) {
                    $second_answer = $row2['second_answer'];
                } else {
                    $second_answer = 0;
                }

                if (isset($row2['third_answer']) > 0) {
                    $third_answer = $row2['third_answer'];
                } else {
                    $third_answer = 0;
                }

                if (isset($row2['fourth_answer']) > 0) {
                    $fourth_answer = $row2['fourth_answer'];
                } else {
                    $fourth_answer = 0;
                }

                if (isset($row2['fifth_answer']) > 0) {
                    $fifth_answer = $row2['fifth_answer'];
                } else {
                    $fifth_answer = 0;
                }

                if (isset($row2['reason']) > 0) {
                    $reason = $row2['reason'];
                } else {
                    $reason = 0;
                }
            ?>
                <label style="font-weight: bold;"><?php echo $sn++ . '. ' . $question; ?></label><br />
                <?php
                //To get usersAnswer

                //Using Switch Case
                switch ($student_answer) {
                    case 0: {
                            $studentAnswer = "None";
                        }
                        break;

                    case 1: {
                            $studentAnswer = $first_answer;
                        }
                        break;
                    case 2: {
                            $studentAnswer = $second_answer;
                        }
                        break;
                    case 3: {
                            $studentAnswer = $third_answer;
                        }
                        break;
                    case 4: {
                            $studentAnswerr = $fourth_answer;
                        }
                        break;
                    case 5: {
                            $studentAnswer = $fifth_answer;
                        }
                        break;
                }
                //To get rightAnswer
                switch ($right_answer) {
                    case 0: {
                            $rightAnswer = "None";
                        }
                        break;

                    case 1: {
                            $rightAnswer = $first_answer;
                        }
                        break;
                    case 2: {
                            $rightAnswer = $second_answer;
                        }
                        break;
                    case 3: {
                            $rightAnswer = $third_answer;
                        }
                        break;
                    case 4: {
                            $rightAnswer = $fourth_answer;
                        }
                        break;
                    case 5: {
                            $rightAnswer = $fifth_answer;
                        }
                        break;
                }
                ?>
                <label>Student's Answer: </label>
                <?php
                if ($studentAnswer == $rightAnswer) {
                ?>
                    <label style="color: green;"><?php echo $studentAnswer; ?></label>
                <?php
                } else {
                ?>
                    <label style="color: red;"><?php echo $studentAnswer; ?></label>
                <?php
                }
                ?>

                <br />
                <label>Correct Answer:</label><label style="color: green;"><?php echo $rightAnswer; ?></label><br />


                <?php
                if ($reason != "") {
                    echo "<div class='success'>" . $reason . "</div>";
                }
                ?>
                <hr />
            <?php
            }
            ?>
            <a href="<?php echo SITEURL; ?>teacher/index.php?page=dashboard">
                <button type="button" class="btn-add">Go Home</button>
            </a>


        </div>
    </div>
</div>
<!--Body Ends Here-->