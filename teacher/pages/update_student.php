<!--Body Starts Here-->
<?php
include('check.php');
if (isset($_GET['student_id']) || isset($_GET['student_username'])) {
    $tbl_name = 'tbl_student';
    $username = $_GET['student_username'];
    $student_id = $obj->get_student_id($tbl_name, $username, $conn);
    $where = "student_id=$student_id";
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    $count_rows = $obj->num_rows($res);
    if ($count_rows == 1) {
        $row = $obj->fetch_data($res);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $username = $row['username'];
        $password = $row['password'];
        $contact = $row['contact'];
        $gender = $row['gender'];
        // $add_subject_id = $row['subject_id'];
        $is_active = $row['is_active'];
    } else {
        header('location:' . SITEURL . 'teacher/index.php?page=students');
    }
} else {
    header('location:' . SITEURL . 'teacher/index.php?page=students');
}
?>
<div class="main">
    <div class="content">
        <div class="report">

            <form method="post" action="" class="forms">
                <h2>Update Student</h2>
                <?php
                if (isset($_SESSION['validation'])) {
                    echo $_SESSION['validation'];
                    unset($_SESSION['validation']);
                }
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <span class="name">First Name</span>
                <input type="text" name="first_name" value="<?php echo $first_name; ?>" required="true" /> <br />

                <span class="name">Last Name</span>
                <input type="text" name="last_name" value="<?php echo $last_name; ?>" required="true" /><br />

                <span class="name">Email</span>
                <input type="email" name="email" value="<?php echo $email; ?>" required="true" /><br />

                <span class="name">Username</span>
                <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />

                <span class="name">Password</span>
                <input type="text" name="password" value="<?php echo $password; ?>" required="true" /><br />

                <span class="name">Contact</span>
                <input type="tel" name="contact" value="<?php echo $contact; ?>" /><br />

                <span class="name">Gender</span>
                <input <?php if ($gender == 'male') {
                            echo "checked='checked'";
                        } ?> type="radio" name="gender" value="male" /> Male
                <input <?php if ($gender == 'female') {
                            echo "checked='checked'";
                        } ?> type="radio" name="gender" value="female" /> Female
                <input <?php if ($gender == 'other') {
                            echo "checked='checked'";
                        } ?> type="radio" name="gender" value="other" /> Other
                <br />

                <!-- <span class="name">Subjcet</span>
                <select name="subject_id">
                    <?php
                    //Get Faculties from database
                    $tbl_name = "tbl_subject";
                    $query = $obj->select_data($tbl_name);
                    $res = $obj->execute_query($conn, $query);
                    $count_rows = $obj->num_rows($res);
                    if ($count_rows > 0) {
                        while ($row = $obj->fetch_data($res)) {
                            $subject_id = $row['subject_id'];
                            $subject_name = $row['subject_name'];
                    ?>
                            <option <?php if ($add_subject_id == $subject_id) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo $subject_id; ?>"><?php echo $subject_name; ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option value="0">Uncategorized</option>
                    <?php
                    }
                    ?>
                </select> -->
                <br />

                <span class="name">Active</span>
                <input <?php if ($is_active == 'yes') {
                            echo "checked='checked'";
                        } ?> type="radio" name="is_active" value="yes" /> Yes
                <input <?php if ($is_active == 'no') {
                            echo "checked='checked'";
                        } ?> type="radio" name="is_active" value="no" /> No
                <br />

                <input type="submit" name="submit" value="Update Student" class="btn-update" style="margin-left: 15%;" />
                <a href="<?php echo SITEURL; ?>teacher/index.php?page=students"><button type="button" class="btn-delete">Cancel</button></a>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                //echo "Clicked";
                $first_name = $obj->sanitize($conn, $_POST['first_name']);
                $last_name = $obj->sanitize($conn, $_POST['last_name']);
                // $update_subject_id = $obj->sanitize($conn, $_POST['subject_id']);
                $email = $obj->sanitize($conn, $_POST['email']);
                $username = $obj->sanitize($conn, $_POST['username']);
                $password = $obj->sanitize($conn, $_POST['password']);
                $contact = $obj->sanitize($conn, $_POST['contact']);

                if (isset($_POST['gender'])) {
                    $gender = $_POST['gender'];
                }
                $subject = $_POST['subject'];
                if (isset($_POST['is_active'])) {
                    $is_active = $_POST['is_active'];
                }
                $updated_date = date('Y-m-d');

                //Normal Validation
                if (($first_name || $last_name || $username || $password) == null) {
                    //SET SSESSION Message
                    $_SESSION['validation'] = "<div class='error'>First Name or Last Name, or Email or Username or Password is Empty.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=update_student&student_id=' . $student_id);
                }
                //Set Table name to update
                $tbl_name = 'tbl_student';
                //SEt New Data to Change
                $data = "first_name='$first_name',
                                    last_name='$last_name',
                                    email='$email',
                                    username='$username',
                                    password='$password',
                                    contact='$contact',
                                    gender='$gender',
                                    is_active='$is_active',
                                    updated_date='$updated_date'
                                    ";
                $where = "student_id=$student_id";
                $query = $obj->update_data($tbl_name, $data, $where);
                $res = $obj->execute_query($conn, $query);
                if ($res === true) {
                    $_SESSION['update'] = "<div class='success'>Student detail successfully updated.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=students');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update student details.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=update_student&student_id=' . $student_id);
                }
            }
            ?>
        </div>
    </div>
</div>
<!--Body Ends Here-->