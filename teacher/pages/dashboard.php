<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2><u>Dash Board</u></h2>

            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['fail'])) {
                echo $_SESSION['fail'];
                unset($_SESSION['fail']);
            }
            ?>

            <div class="clearfix">
                <a href="<?php echo SITEURL; ?>teacher/index.php?page=students">
                    <div class="dash-tile">
                        <h1>
                            <?php
                            $teacher_id = $_SESSION["teacher_id"];
                            $query = "
                            SELECT *
                            FROM tbl_student
                            WHERE subject_id IN (SELECT subject_id FROM tbl_subject WHERE teacher_id = '.$teacher_id.')";
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            unset($res);
                            echo $count_rows;
                            ?>
                        </h1>
                        <span>Students</span>
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>teacher/index.php?page=subjects">
                    <div class="dash-tile">
                        <h1>
                            <?php
                            $teacher_id = $_SESSION["teacher_id"];
                            $query = "SELECT * FROM tbl_subject WHERE teacher_id = '$teacher_id'";
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            unset($res);
                            echo $count_rows;
                            ?>
                        </h1>
                        <span>Subjects</span>
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>teacher/index.php?page=questions">
                    <div class="dash-tile">
                        <h1>
                            <?php
                            $teacher_id = $_SESSION["teacher_id"];
                            $query = "
                            SELECT *
                            FROM tbl_question
                            WHERE subject_id IN (SELECT subject_id FROM tbl_subject WHERE teacher_id = '.$teacher_id.')";
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            unset($res);
                            echo $count_rows;
                            ?>
                        </h1>
                        <span>Questions</span>
                    </div>
                </a>

                <a href="<?php echo SITEURL; ?>teacher/index.php?page=results">
                    <div class="dash-tile">
                        <h1>
                            <?php
                            $teacher_id = $_SESSION["teacher_id"];
                            $query = "
                            SELECT *
                            FROM tbl_result_summary
                            WHERE student_id IN (SELECT question_id FROM tbl_question 
                            WHERE subject_id IN (SELECT subject_id FROM tbl_subject where teacher_id = '.$teacher_id.'))";
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            unset($res);
                            echo $count_rows;
                            ?>
                        </h1>
                        <span>Results</span>
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>
<!--Body Ends Here-->