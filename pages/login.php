<!--Body Starts Here-->
<div class="main">
    <div class="wrapper">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <form method="post" action="" class="d-flex flex-column">
                <div class="h3 text-center text-white">
                    <img src="https://i.ibb.co/KX4XZSL/removal-ai-tmp-634a698c25201-2.png" height="375" width="375">
                </div>
                <?php
                if (isset($_SESSION['invalid'])) {
                    echo $_SESSION['invalid'];
                    unset($_SESSION['invalid']);
                }
                ?>

                <div class="d-flex align-items-center input-field my-0 mb-4">
                    <span class="far fa-user p-2"></span>
                    <input type="text" name="username" placeholder="Username" placeholder="Username" required class="form-control">
                </div>

                <div class="d-flex align-items-center input-field mb-4">
                    <span class="fas fa-lock p-2"></span>
                    <input type="password" placeholder="Password" name="password" required class="form-control" id="pwd">
                    <button<input class="ms-2 me-1" type="btn-check" onclick="showPassword()"><span id="icon_pwd" class="fa-solid fa-eye"></span></button>
                </div>

                <div class="d-sm-flex align-items-sm-center justify-content-sm-between">
                    <div class="d-flex align-items-center">
                        <label class="option">
                            <span class="text-light-white">Ingat Saya</span>
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="mt-sm-0 mt-3"><a href="#">Lupa Password?</a></div>
                </div>

                <div class="d-flex justify-content-start mt-2">
                    <div class="me-2">
                        <input type="submit" name="submit" value="Masuk" class="btn btn-secondary">
                    </div>

                    <div>
                        <input type="reset" name="reset" value="Bersihkan" class="btn btn-secondary" />
                    </div>
                </div>

                <div class="mb-3">
                    <span class="text-light-white">Tidak punya akun?</span>
                    <a href="#">Daftar</a>
                </div>

                <center>
                    <div class="mb-3 form-check">
                        <input style="display:none" class="form-check-input" type="radio" name="exampleRadios" id="teacherRadios" value="teacher" checked>
                        <label class="form-check-label" for="teacherRadios">
                            <div>
                                <a href="teacher/index.php?page=dashboard">
                                    <div>
                                        <i class="fa-sharp fa-solid fa-person-chalkboard"></i>
                                    </div>
                                    <div class="m-2">
                                        Masuk Sebagai Guru
                                    </div>
                                </a>
                            </div>
                        </label>
                    </div>
                </center>

            </form>

            <?php
            if (isset($_POST['submit'])) {
                //echo "CLicked";
                //Get Values from forms
                $username = $obj->sanitize($conn, $_POST['username']);
                $password = $obj->sanitize($conn, $_POST['password']);
                //Check Login
                $tbl_name = "tbl_student";
                $where = "username='$username' && password='$password' && role='student'";
                $query = $obj->select_data($tbl_name, $where);
                $res = $obj->execute_query($conn, $query);
                $count_rows = $obj->num_rows($res);
                if ($count_rows > 0) {
                    $value = $res->fetch_object();
                    $_SESSION['student_id'] = $value->student_id;
                    $_SESSION['student_username'] = $username;
                    $_SESSION['student_password'] = $password;
                    $_SESSION['login'] = "
                    <script>
                    Swal.fire(
                        'Berhasil Masuk',
                        '',
                        'success'
                      )
                    </script>
                    ";
                    header('location:' . SITEURL . 'index.php?page=home');
                } else {
                    $_SESSION['invalid'] = "
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pasword atau Username yang kamu masukkan salah!',
                      })
                    </script>
                    ";
                    header('location:' . SITEURL . 'index.php?page=login');
                }
            }
            ?>

        </div>
    </div>
    <!-- script show password -->
    <script>
        function showPassword() {
            var password = document.getElementById('pwd');
            var icon_password = document.getElementById('icon_pwd');
            if (password.type === 'password') {
                password.type = "text";
                icon_password.classList.add("fa-eye-slash");
                icon_password.classList.remove("fa-eye");
            } else {
                password.type = "password";
                icon_password.classList.add("fa-eye");
                icon_password.classList.remove("fa-eye-slash");
            }
        }
    </script>
</div>
<!--Body Ends Here-->