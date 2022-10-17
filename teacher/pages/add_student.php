<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2 class="mb-5">Add Student</h2>
            <form method="post" action="" class="card row p-5 shadow-lg p-3 mb-5 bg-body rounded">
                <?php
                if (isset($_SESSION['validation'])) {
                    echo $_SESSION['validation'];
                    unset($_SESSION['validation']);
                }
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                ?>
                <div class="col-md-12">
                    <label for="inputFirstName" class="form-label">First Name</label>
                    <input id="inputFirstName" type="text" name="first_name" class="form-control" placeholder="First Name" required="true" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : ''; ?>" /> <br />
                </div>
                <div class="col-md-12">
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input id="inputLastName" type="text" name="last_name" class="form-control" placeholder="Last Name" required="true" /><br />
                </div>
                <div class="col-md-12">
                    <span class="form-label">Email</span>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required="true" /><br />
                </div>
                <div>
                    <span class="form-label">Username</span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required="true" /><br />
                </div>
                <div>
                    <span class="form-label">Password</span>
                    <input type="text" name="password" class="form-control" placeholder="Password" required="true" /><br />
                </div>
                <div>
                    <span class="form-label">Contact</span>
                    <input type="tel" name="contact" class="form-control" placeholder="Contact Number" /><br />
                </div>
                <div>
                    <span class="form-label">Gender</span>
                    <div class="forn-check">
                        <input type="radio" class="form-check-input" name="gender" value="male" /> Male
                        <input type="radio" class="form-check-input" name="gender" value="female" /> Female
                        <input type="radio" class="form-check-input" name="gender" value="other" /> Other
                    </div>
                    <br />
                </div>
                <div>
                    <span class="form-label">Subject</span>
                    <select name="subject_id">
                        <?php
                        //Get Subject from database
                        $tbl_name = "tbl_subject";
                        $teacher_id = $_SESSION['teacher_id'];
                        $where = "teacher_id='$teacher_id'";
                        $query = $obj->select_data($tbl_name, $where);
                        $res = $obj->execute_query($conn, $query);
                        $count_rows = $obj->num_rows($res);
                        if ($count_rows > 0) {
                            while ($row = $obj->fetch_data($res)) {
                                $subject_id = $row['subject_id'];
                                $subject_name = $row['subject_name'];
                        ?>
                                <option value="<?php echo $subject_id; ?>"><?php echo $subject_name; ?></option>
                        <?php
                            }
                        } else {
                            echo ("<option value='none'>Belum ada kelas</option>");
                        }
                        ?>
                    </select>
                </div>
                <br />
                <div>
                    <input type="submit" name="submit" value="Add Student" class="btn btn-success" style="margin-left: 15%;" />
                    <a href="<?php echo SITEURL; ?>teacher/index.php?page=students">
                        <button type="button" class="btn btn-warning">
                            Cancel
                        </button>
                    </a>
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                //Getting Values from the form
                $first_name = $obj->sanitize($conn, $_POST['first_name']);
                $last_name = $obj->sanitize($conn, $_POST['last_name']);
                $email = $obj->sanitize($conn, $_POST['email']);
                $username = $obj->sanitize($conn, $_POST['username']);

                $password = $obj->sanitize($conn, $_POST['password']);
                $contact = $obj->sanitize($conn, $_POST['contact']);
                if (isset($_POST['gender'])) {
                    $gender = $obj->sanitize($conn, $_POST['gender']);
                } else {
                    $gender = 'male';
                }

                $add_subject_id = $obj->sanitize($conn, $_POST['subject_id']);
                $added_date = date('Y-m-d');

                //Backend Validation, Checking whether the input fields are empty or not
                if (($first_name || $last_name || $email || $username || $password) == null) {
                    //SET SSESSION Message
                    $_SESSION['validation'] = "<div class='error'>First Name or Last Name, or Email or Username or Password is Empty.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=add_student');
                }

                // Check if exist
                $tbl_name = 'tbl_student';
                $where    = "username='$username'";
                $query = $obj->select_data($tbl_name, $where);
                $res = $obj->execute_query($conn, $query);
                $count_rows = $obj->num_rows($res);
                unset($tbl_name);
                unset($query);
                unset($res);
                //Addding to the database
                $tbl_name = 'tbl_student';
                $data = "first_name='$first_name',
                                    last_name='$last_name',
                                    email='$email',
                                    username='$username',
                                    password='$password',
                                    contact='$contact',
                                    gender='$gender',
                                    role='student',
                                    subject_id='$add_subject_id',
                                    is_active='yes',
                                    added_date='$added_date',
                                    updated_date=''";
                $query = $obj->insert_data($tbl_name, $data);
                if ($count_rows < 1) {
                    $res = $obj->execute_query($conn, $query);
                    if ($res === true) {
                        $_SESSION['add'] = "<div class='success'>New student successfully added.</div>";
                        header('location:' . SITEURL . 'teacher/index.php?page=students');
                    } else {
                        $_SESSION['add'] = "<div class='alert alert-danger'>Gagal mendaftarkan siswa.</div>";
                        header('location:' . SITEURL . 'teacher/index.php?page=add_student');
                    }
                } else {
                    $fm = $_POST["first_name"];
                    $_SESSION['add'] = "<div class='alert alert-danger'>Gagal mendaftarkan siswa, silahkan coba dengan mencoba Username lain $fm.</div>";
                    header('location:' . SITEURL . 'teacher/index.php?page=add_student');
                }
            }
            ?>
        </div>
    </div>
</div>
<!--Body Ends Here-->