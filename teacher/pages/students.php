<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Student Manager</h2>

            <a href="<?php echo SITEURL; ?>teacher/index.php?page=add_student">
                <button type="button" class="btn btn-success mb-5">
                    <i class="fa-solid fa-plus"></i>
                    Add Student
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
                    <table id="table-student" class="display nowrap" style="width:100%" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!--Displaying All Data From Database-->
                            <?php
                            $teacher_id = $_SESSION['teacher_id'];
                            $query = "
                             SELECT *
                             FROM tbl_student
                             WHERE subject_id IN (SELECT subject_id FROM tbl_subject WHERE teacher_id = '.$teacher_id.')";
                            // $query = "SELECT * FROM tbl_student ORDER BY student_id DESC";
                            $sn = 1;
                            $res = $obj->execute_query($conn, $query);
                            $count_rows = $obj->num_rows($res);
                            ?>
                            <?php foreach ($res as $data) : ?>
                                <tr>
                                    <?php
                                    $student_id = $data['student_id'];
                                    $first_name = $data['first_name'];
                                    $last_name = $data['last_name'];
                                    $username = $data['username'];
                                    $full_name = $first_name . ' ' . $last_name;
                                    ?>
                                    <td><?php echo $sn++; ?> </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['contact']; ?></td>
                                    <!-- <td>
                                        <?php
                                        //Get Subject Name from subject_id
                                        unset($tbl_name);
                                        $student_subject_id = $data['subject_id'];
                                        $tbl_name = "tbl_subject";
                                        $subject_name = $obj->get_subject_name($tbl_name, $student_subject_id, $conn);
                                        echo $subject_name;
                                        ?>
                                    </td> -->
                                    <td><?php echo $data['is_active']; ?></td>
                                    <td>
                                        <ul class="mt-3">
                                            <li style="list-style-type : none">
                                                <a href="<?php echo SITEURL; ?>teacher/index.php?page=update_student&student_username=<?php echo $username; ?>">
                                                    <button style="width: 100px;" name="update_student" type="submit" class="btn btn-info btn-block">
                                                        <i class="fa-solid fa-pen-to-square"></i>Edit
                                                    </button>
                                                </a>
                                            </li>
                                            <li style="list-style-type : none" class="my-2">
                                                <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="submit" style="width: 100px;" name="delete_student" class="btn btn-danger btn-block"><i class="fa-solid fa-trash"></i>Hapus</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Data akan dihapus!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <form method="POST" role="form" action="pages/delete.php">
                                                                    <input type="hidden" value="<?php echo $student_id; ?>" name="student_id">
                                                                    <button type="submit" class="btn btn-primary" name="delete_student" class="btn btn-danger btn-block">Understood</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table-student').DataTable({
            responsive: true
        });
    });
</script>
<script>

</script>
<!--Body Ends Here-->