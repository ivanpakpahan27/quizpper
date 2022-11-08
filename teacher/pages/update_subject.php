<!--Body Starts Here-->
<?php
include('check.php');
if (isset($_GET['id'])) {
    $subject_id = $_GET['id'];
    //Getting VAlues fro the datadabase
    $tbl_name = "tbl_subject";
    $where = "subject_id=$subject_id";
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    $count_rows = $obj->num_rows($res);
    if ($count_rows == 1) {
        $row = $obj->fetch_data($res);
        $teacher_id = $row['teacher_id'];
        $subject_name = $row['subject_name'];
        $time_duration = $row['time_duration'];
        $qns_per_page = $row['qns_per_set'];
        $total_english = $row['total_english'];
        $total_math = $row['total_math'];
        $is_active = $row['is_active'];
        if (($_SESSION['teacher_id']) != $teacher_id) {
            header('location:' . SITEURL . 'error404.html');
        }
    } else {
        header('location:' . SITEURL . 'teacher/index.php?page=subjects');
    }
} else {
    header('location:' . SITEURL . 'teacher/index.php?page=subjects');
}
?>
<div class="main">
    <div class="content">
        <div class="report">

            <form method="post" action="" class="forms card row p-5 shadow-lg p-3 mb-5 bg-body rounded">
                <h2>Edit Kuis</h2>
                <?php
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <div class="col-md-12">
                    <label for="subjectName" class="form-label">Subject Title</label> <br />
                    <input id="subjectName" class="form-control" type="text" name="subject_name" value="<?php echo $subject_name; ?>" required="true" /> <br />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Time Duration</label> <br />
                    <input class="form-control" type="number" name="time_duration" value="<?php echo $time_duration; ?>" required="true" /><br />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Questions/Set</label> <br />
                    <input class="form-control" type="number" name="qns_per_page" value="<?php echo $qns_per_page; ?>" required="true" /><br />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Total English Qns</label> <br />
                    <input class="form-control" type="number" name="total_english_qns" value="<?php echo $total_english; ?>" required="true" /><br />
                </div>
                <div class="col-md-12">
                    <label class="form-label">Total Math Qns</label> <br />
                    <input class="form-control" type="number" name="total_math_qns" value="<?php echo $total_math; ?>" /><br />
                </div>
                <div>
                    <label class="form-label">Is Active?</label> <br />
                    <input <?php if ($is_active == "yes") {
                                echo "checked='checked'";
                            } ?> type="radio" name="is_active" value="yes" /> Yes
                    <input <?php if ($is_active == "no") {
                                echo "checked='checked'";
                            } ?> type="radio" name="is_active" value="no" /> No
                </div>
                <br />
                <div>
                    <input type="submit" name="submit" value="Update Subject" class="btn btn-info" style="margin-left: 15%;" />
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                //echo "Clcked";
                //Getting all the values from the forms
                $subject_name = $obj->sanitize($conn, $_POST['subject_name']);
                $time_duration = $obj->sanitize($conn, $_POST['time_duration']);
                $qns_per_page = $obj->sanitize($conn, $_POST['qns_per_page']);
                $total_english = $obj->sanitize($conn, $_POST['total_english_qns']);
                $total_math = $obj->sanitize($conn, $_POST['total_math_qns']);
                $is_active = $obj->sanitize($conn, $_POST['is_active']);
                $updated_date = date('Y-m-d');

                $tbl_name = 'tbl_subject';
                $data = "subject_name='$subject_name',
                                    time_duration='$time_duration',
                                    qns_per_set='$qns_per_page',
                                    total_english='$total_english',
                                    total_math='$total_math',
                                    is_active='$is_active',
                                    updated_date='$updated_date'";
                $where = "subject_id='$subject_id'";
                $query = $obj->update_data($tbl_name, $data, $where);
                $res = $obj->execute_query($conn, $query);
                if ($res === true) {
                    $_SESSION['update'] = "<div class='success'>Subject successfully updated.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=subjects');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update Subject. Please try again.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=update_subject&id=' . $subject_id);
                }
            }
            ?>
        </div>
    </div>
</div>
<!--Body Ends Here-->