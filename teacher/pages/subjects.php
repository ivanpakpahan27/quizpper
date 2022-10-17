<?php
include('check.php');
?>
<!--Body Starts Here-->
<div class="main">
    <div class="content">
        <div class="report">
            <h2>Subject Manager</h2>
            <a href="<?php echo SITEURL; ?>teacher/index.php?page=add_subject">
                <button type="button" class="btn-add">Add Subject</button>
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

            <table>
                <tr>
                    <th>S.N.</th>
                    <th>Subject Title</th>
                    <th>Time Duration</th>
                    <th>Qns Per Exam</th>
                    <th>Is Active?</th>
                    <th>Actions</th>
                </tr>

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
                ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $subject_name; ?></td>
                            <td><?php echo $time_duration; ?></td>
                            <td><?php echo $qns_per_page; ?></td>
                            <td><?php echo $is_active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>teacher/index.php?page=update_subject&id=<?php echo $subject_id; ?>"><button type="button" class="btn-update">UPDATE</button></a>
                                <br>
                                <form action="pages/delete.php" method="POST">
                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                    <button type="submit" name="delete_subject" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'><div class='error'>No subjects added.</div></td></tr>";
                }
                ?>


            </table>
        </div>
    </div>
</div>
<!--Body Ends Here-->