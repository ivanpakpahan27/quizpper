<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Subject Manager</h2>
            <a href="<?php echo SITEURL; ?>teacher/index.php?page=add_subject">
                <button type="button" class="btn btn-success mb-5">
                    <i class="fa-solid fa-plus"></i>
                    Add Subject
                </button>
            </a>
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
            <div class="table-responsive card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="m-5">

                    <table id="table-subjects" class="display nowrap" style="width:100%" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Nama Subyek</th>
                                <th>Durasi (Menit)</th>
                                <th>Jumlah Soal</th>
                                <th>Aktif</th>
                                <th>Poin Benar</th>
                                <th>Poin Salah</th>
                                <th>Jadwal Mulai</th>
                                <th>Jadwal Akhir</th>
                                <th>Aksi</th>
                                <th>Pertanyaan</th>
                                <th>Siswa</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Getting all the subject from database
                            $tbl_name = "tbl_subject ORDER BY subject_id DESC";
                            $query = $obj->select_data($tbl_name);
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
                            ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $subject_name; ?></td>
                                        <td><?php echo $time_duration; ?></td>
                                        <td><?php echo $total_question; ?></td>
                                        <td><?php echo $is_active; ?></td>
                                        <td>
                                            <?php echo $mark_right; ?>
                                        </td>
                                        <td>
                                            <?php echo $mark_false; ?>
                                        </td>
                                        <td>

                                            <?php echo date("d M Y H:i:s", strtotime($start_time)); ?>
                                        </td>
                                        <td>
                                            <?php echo date("d M Y H:i:s", strtotime($end_time)); ?>
                                        </td>
                                        <td>
                                            <div style="display: flex;">
                                                <a href="<?php echo SITEURL; ?>teacher/index.php?page=update_subject&id=<?php echo $subject_id; ?>">
                                                    <button type="button" class="btn btn-warning">Edit</button></a>
                                                <form action="pages/delete.php" method="POST">
                                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                                    <button type="submit" name="delete_subject" class="btn btn-danger ms-3" onclick="return confirm('Are you sure?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="margin-left: 80px;">
                                                <button class="btn btn-success">Lihat</button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-success">Lihat</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-success">Lihat</button>
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
<script>
    $(document).ready(function() {
        $('#table-subjects').DataTable({
            responsive: true
        });
    });
</script>
<!--Body Ends Here-->