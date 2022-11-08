<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Manajemen Kuis</h2>
            <button type="button" class="btn btn-success mb-5" data-bs-toggle="modal" data-target=".bd-example-modal-lg" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>
                Tambah Kuis
            </button>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            ?>
            <div class="text-center table-responsive card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="m-5">

                    <table id="table-subjects" class="text-center display nowrap cell-border compact stripe" style="width:100%" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S.N.</th>
                                <th>Nama Subyek</th>
                                <th>Token</th>
                                <th>Aksi</th>
                                <th>Pertanyaan</th>
                                <th>Siswa</th>
                                <th>Review</th>
                                <th>Durasi (Menit)</th>
                                <th>Jumlah Soal</th>
                                <th>Aktif</th>
                                <th>Poin Benar</th>
                                <th>Poin Salah</th>
                                <th>Jadwal Mulai</th>
                                <th>Jadwal Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Getting all the subject from database
                            $tbl_name = "tbl_subject";
                            $where =  "teacher_id =" . $_SESSION['teacher_id'] . " ORDER BY subject_id DESC";
                            $query = $obj->select_data($tbl_name, $where);
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            $sn = 1;
                            if ($count_rows > 0) {
                                while ($row = $obj->fetch_data($res)) {
                                    $subject_id = $row['subject_id'];
                                    $subject_name = $row['subject_name'];
                                    $time_duration = $row['time_duration'];
                                    $qns_per_page = $row['qns_per_set'];
                                    $is_active = $row['is_active'];
                                    $total_question = $row['total_question'];
                                    $mark_right = $row['mark_right'];
                                    $mark_false = $row['mark_false'];
                                    $start_time = $row['start_time'];
                                    $end_time = $row['end_time'];
                                    $enroll_token = $row['enroll_token'];
                            ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td>
                                            <div><?php echo $subject_name; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $enroll_token; ?></div>
                                        </td>
                                        <td>
                                            <div class="mb-2">
                                                <a href="<?php echo SITEURL; ?>teacher/index.php?page=update_subject&id=<?php echo $subject_id; ?>">
                                                    <button style="width:88px" type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger deleteSubject" data-id="<?php echo $subject_id; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                                </button>
                                            </div>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah kamu yakin?,<br>
                                                            semua data yang berkaitan akan dihapus!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                            <form action="pages/delete.php" method="POST">
                                                                <input type="hidden" value="" id="subject_id" name="subject_id">
                                                                <button type="submit" name="delete_subject" class="btn btn-danger"> Ya</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-success"><i class="fa-solid fa-eye"></i> Lihat</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-success"><i class="fa-solid fa-eye"></i> Lihat</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <button class="btn btn-success"><i class="fa-solid fa-eye"></i> Lihat</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div><?php echo $time_duration; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $total_question; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $is_active; ?></div>
                                        </td>
                                        <td>
                                            <div><?php echo $mark_right; ?></div>
                                        </td>
                                        <td>
                                            <div>
                                                <?php echo $mark_false; ?>
                                            </div>
                                        </td>
                                        <td>

                                            <?php echo date("d M Y H:i:s", strtotime($start_time)); ?>
                                        </td>
                                        <td>
                                            <?php echo date("d M Y H:i:s", strtotime($end_time)); ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'><div class='error'>No subjects added.</div></td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Add Subject -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Kuis
                </h5>
            </div>
            <div class="modal-body">
                <form method="post" action="" class="forms">
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
                    <span class="name">Judul Kuis</span>
                    <input class="form-control" type="text" name="subject_name" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /> <br />

                    <div class="input-group mb-3">
                        <span class="input-group-text name me-3">Token</span>
                        <input id="target" maxlength="6" minlength="6" class="form-control" type="text" name="enroll_token" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong dan minimal 6 karakter!')" onchange="this.setCustomValidity('')" /><br />
                        <button class="btn" type="button" id="gen" onClick="generate()"><i class="fa-solid fa-arrows-rotate"></i></button>
                    </div>

                    <span class="name">Durasi (Menit)</span>
                    <input class="form-control" type="number" min="1" name="time_duration" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /><br />

                    <span class="name">Kuis/Set</span>
                    <input class="form-control" type="number" min="0" name="qns_per_page" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /><br />

                    <span class="name">Total Soal Bahasa Inggris</span>
                    <input class="form-control" type="number" min="0" name="total_english_qns" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /><br />

                    <span class="name">Total Soal Math</span>
                    <input class="form-control" type="number" min="0" name="total_math_qns" /><br />

                    <span class="name">Poin Soal Benar</span>
                    <input class="form-control" type="number" min="0" name="mark_right" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /><br />

                    <span class="name">Poin Soal Salah (Minus)</span>
                    <input class="form-control" type="number" min="0" name="mark_false" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')" /><br />

                    <div class="mb-3">
                        <span class="name">Waktu Dimulai</span>
                        <input class="form-control" type="datetime-local" id="start_time" name="start_time" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')">

                        <span class="name">Waktu Berakhir</span>
                        <input class="form-control" type="datetime-local" id="end_time" name="end_time" required="true" oninvalid="this.setCustomValidity('Form tidak boleh kosong!')" onchange="this.setCustomValidity('')">
                    </div>

                    <div hidden>
                        <span class="name">Status</span>
                        <input type="radio" name="is_active" value="yes" /> Yes
                        <input type="radio" name="is_active" value="no" /> No
                    </div>

                    <?php
                    if (isset($_POST['submit'])) {
                        //echo "Clicked";
                        //Get Values froom the form
                        $subject_name = $obj->sanitize($conn, $_POST['subject_name']);
                        $enroll_token = $_POST['enroll_token'];
                        $time_duration = $obj->sanitize($conn, $_POST['time_duration']);
                        $qns_per_page = $obj->sanitize($conn, $_POST['qns_per_page']);
                        $total_english = $obj->sanitize($conn, $_POST['total_english_qns']);
                        $total_math = $obj->sanitize($conn, $_POST['total_math_qns']);
                        $mark_right = $_POST['mark_right'];
                        $mark_false = $_POST['mark_false'];
                        $start_time = $_POST['start_time'];
                        $end_time = $_POST['end_time'];
                        if (isset($_POST['is_active'])) {
                            $is_active = $obj->sanitize($conn, $_POST['is_active']);
                        } else {
                            $is_active = "yes";
                        }
                        $added_date = date('Y-m-d');

                        //Normal PHP Validation
                        // if (($subject_name == "") || ($time_duration == "") || ($qns_per_page == "")) {
                        //     $_SESSION['validation'] = "<div class='error'>Subject name or Time Duration or Question Per Page is Empty.</div>";
                        //     header('location:' . SITEURL . 'teacher/index.php?page=subject');
                        // }
                        unset($query);
                        unset($res);
                        unset($count_rows);
                        $query = "SELECT * FROM tbl_subject WHERE enroll_token='$enroll_token'";
                        $res = $obj->execute_query($conn, $query);
                        $count_rows = $obj->num_rows($res);
                        if ($count_rows < 1) {
                            //Inserting into the database
                            $tbl_name = 'tbl_subject';
                            $teacher_id = $_SESSION['teacher_id'];
                            $data = "subject_name='$subject_name',
                                    enroll_token='$enroll_token',
                                    teacher_id='$teacher_id',
                                    total_question='0',
                                    time_duration='$time_duration',
                                    qns_per_set='$qns_per_page',
                                    total_english='$total_english',
                                    total_math='$total_math',
                                    is_active='$is_active',
                                    added_date='$added_date',
                                    mark_right='$mark_right',
                                    mark_false='$mark_false',
                                    start_time='$start_time',
                                    end_time='$end_time',
                                    updated_date=''";
                            //Query to Insert Data
                            $query = $obj->insert_data($tbl_name, $data);
                            $res = $obj->execute_query($conn, $query);
                            if ($res === true) {
                                //Success Message
                                $_SESSION['add'] = "<div class='alert alert-success'>Kuis baru berhasil ditambahkan.</div>";
                                header('location:' . SITEURL . 'teacher/index.php?page=subjects');
                            } else {
                                //Fail Message
                                $_SESSION['add'] = "<div class='alert alert-danger'>Gagal menambahkan kuis baru</div>";
                                header('location:' . SITEURL . 'teacher/index.php?page=subjects');
                            }
                        } else {
                            //Fail Message
                            $_SESSION['add'] = "<div class='alert alert-danger'>Gagal menambahkan kuis, token sudah ada</div>";
                            header('location:' . SITEURL . 'teacher/index.php?page=subjects');
                        }
                    }
                    ?>
            </div>
            <div class="modal-footer">
                <input type="submit" name="submit" value="Tambah Kuis" ) class="btn btn-primary" style="margin-left: 15%;" />
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------- -->

<script>
    $(document).ready(function() {
        $('#table-subjects').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });
    });
</script>

<script>
    function generate() {
        let length = 6;
        const characters = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let result = '';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result +=
                characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        document.getElementById("target").value = result
    }
</script>
<script>
    $(document).on("click", ".deleteSubject", function() {
        var subject_id = $(this).data('id');
        $(".modal-footer #subject_id").val(subject_id);
    });
</script>
<!--Body Ends Here-->