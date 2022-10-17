<!--Body Starts Here-->
<div class="main">
    <div class="login shadow-lg p-3 mb-5 bg-white rounded">
        <form method="post" action="">
            <h2>Teacher | Log In</h2>
            <?php
            if (isset($_SESSION['validation'])) {
                echo $_SESSION['validation'];
                unset($_SESSION['vaidation']);
            }
            if (isset($_SESSION['fail'])) {
                echo $_SESSION['fail'];
                unset($_SESSION['fail']);
            }
            if (isset($_SESSION['xss'])) {
                echo $_SESSION['xss'];
                unset($_SESSION['xss']);
            }
            ?>
            <input type="text" name="username" class="form-class" placeholder="Username" required="true" />
            <input type="password" name="password" class="form-class" placeholder="Password" required="true" />
            <input type="submit" name="submit" value="Log In" class="btn btn-secondary" />
            <input type="reset" name="reset" value="Reset" class="btn btn-secondary" />
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            $username = $obj->sanitize($conn, $_POST['username']);
            $password_db = md5($obj->sanitize($conn, $_POST['password']));
            $tbl_name = "tbl_teacher";
            $where = "username='$username' AND password='$password_db'";
            $query = $obj->select_data($tbl_name, $where);
            $res = $obj->execute_query($conn, $query);
            $count_rows = $obj->num_rows($res);
            if ($count_rows == 1) {
                $value = $res->fetch_object();
                $_SESSION['teacher_id'] = $value->teacher_id;
                $_SESSION['teacher_username'] = $username;
                $_SESSION['teacher_password'] = $password;
                $_SESSION['success'] = "<div class='success'>Login Successful. Welcome " . $username . " to dashboard.</div>";
                header('location:' . SITEURL . 'teacher/index.php?page=dashboard');
            } else {
                $_SESSION['fail'] = "<div class='error'>Username or Password is invalid. Please try again.</div>";
                header('location:' . SITEURL . 'teacher/index.php?page=login');
            }
        } ?>
    </div>
</div>
<!--Body Ends Here-->