<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="home">
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            //Setting Time Limit Here
            if (!isset($_SESSION['start_time'])) {
                //$_SESSION['start_time']=
            }
            ?>
            <!-- <?php echo $_SESSION['student_id']; ?> -->
            <p class="mb-5">Halo <span class="fw-bold"><?php echo $_SESSION['student_username']; ?></span>. Selamat datang di portal Quizpper.<br /></p>
            <!-- <?php var_dump($_SESSION); ?> -->
            <div class="card mb-5 shadow-lg p-3 mb-5 bg-body rounded">
                <p class="m-2" style="text-align: left;">
                    Berikut adalah beberapa aturan yang wajib kamu ikuti pada aplikasi ini. <br>
                    1. Tes ini bersifat otomatis <br>
                    2. Pendaftaran kelas ujian berdasarkan token yang diberikan guru <br>
                    3. Setelah Anda mengklik "Ikuti Tes", timer akan mulai dan tidak dapat dijeda atau dihentikan. <br>
                    4. Skor langsung dicetak <br>
                </p>
            </div>

            <a href="<?php echo SITEURL; ?>index.php?page=question">
                <button type="button" class="btn btn-primary">Ikuti Tes</button>
            </a>

            <p class="mt-5 text-center">Daftar Kelas</p>

            <?php
            if (isset($_SESSION['enroll_failed'])) {
                echo $_SESSION['enroll_failed'];
                unset($_SESSION['enroll_failed']);
            } elseif (isset($_SESSION['enroll_success'])) {
                echo $_SESSION['enroll_success'];
                unset($_SESSION['enroll_success']);
            } elseif (isset($_SESSION['enroll_already'])) {
                echo $_SESSION['enroll_already'];
                unset($_SESSION['enroll_already']);
            }
            ?>

            <div class="mt-5 registration d-flex justify-content-center">
                <div class="text-center" style="width: 20rem;">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" required="True" class="form-control" name="token_registration" placeholder="Token Kelas" aria-label="Token Kelas" aria-describedby="button-addon2">
                            <button name="submit" class="btn btn-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-key"></i> Mendaftar</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['submit'])) {
                //echo "CLicked";
                //Get Values from forms
                $token_regis = $obj->sanitize($conn, $_POST['token_registration']);
                //Check Login
                $tbl_name = "tbl_subject";
                $where = "enroll_token='$token_regis'";
                $query = $obj->select_data($tbl_name, $where);
                $res = $obj->execute_query($conn, $query);
                $count_rows = $obj->num_rows($res);
                if ($count_rows > 0) {
                    $tbl_name2 = 'tbl_enroll';
                    $value = $res->fetch_object();
                    $subject_id = $value->subject_id;
                    $student_id = $_SESSION['student_id'];
                    $where2 = "subject_id='$subject_id' && student_id='$student_id'";
                    $query2 = $obj->select_data($tbl_name2, $where2);
                    $res2 = $obj->execute_query($conn, $query2);
                    $count_rows = $obj->num_rows($res2);
                    if ($count_rows > 0) {
                        $_SESSION['enroll_already'] = "
                        <script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Kamu sudah terdaftar di kelas ini!'
                        })
                        </script>";
                        header('location:' . SITEURL . 'index.php?page=home');
                    } else {
                        $date = date('Y-m-d H:i:s');
                        $data = "student_id=$student_id,subject_id='$subject_id',date='$date'";
                        //Query to Insert Data
                        $query3 = $obj->insert_data($tbl_name2, $data);
                        $res3 = $obj->execute_query($conn, $query3);
                        $_SESSION['enroll_success'] = "
                        <script>
                        Swal.fire(
                            'Enroll Succesfull!',
                            'Berhasil Mendaftar Kelas!',
                            'success'
                        )
                        </script>";
                        header('location:' . SITEURL . 'index.php?page=home');
                    }
                } else {
                    $_SESSION['enroll_failed'] = "
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Token kelas tidak ditemukan!'
                      })
                    </script>";
                    header('location:' . SITEURL . 'index.php?page=home');
                }
            }
            ?>


        </div>
    </div>
</div>
<!--Body Ends Here-->