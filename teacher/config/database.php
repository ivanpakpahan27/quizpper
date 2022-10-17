<?php
include('constants.php');

class Database
{
    public function db_connect()
    {
        $conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
        return $conn;
    }

    public function db_select($conn)
    {
        $db_select = mysqli_select_db($conn, DBNAME) or die(mysqli_error());
        return $db_select;
    }
    public function select_data($tbl_name, $where = "", $other = "")
    {
        $query = "SELECT * FROM $tbl_name";
        if ($where != "") {
            $query .= " WHERE $where";
        }
        if ($other != "") {
            $query .= ' ' . $other;
        }
        return $query;
    }
    public function select_random_row($tbl_name, $where, $limit)
    {
        $query = "SELECT * FROM $tbl_name";
        if ($where != "") {
            $query .= " WHERE $where  ORDER BY RAND()";
        }
        if ($limit != "") {
            $query .= ' LIMIT ' . $limit;
        }
        return $query;
    }
    public function insert_data($tbl_name, $data)
    {
        $query = "INSERT INTO $tbl_name SET $data";
        return $query;
    }
    public function update_data($tbl_name, $data, $where = "")
    {
        $query = "UPDATE $tbl_name SET $data WHERE $where";
        return $query;
    }
    public function delete_data($tbl_name, $where)
    {
        $query = "DELETE FROM $tbl_name WHERE $where";
        return $query;
    }
    public function execute_query($conn, $query)
    {
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        return $res;
    }
    public function num_rows($res)
    {
        $num_rows = mysqli_num_rows($res);
        return $num_rows;
    }
    public function fetch_data($res)
    {
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    public function check_image_type($ext)
    {
        $valid = array('jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF', 'JPEG');
        if (in_array($ext, $valid)) {
            return true;
        } else {
            return false;
        }
    }
    public function check_file_type($ext)
    {
        $valid = array('pdf', 'docx', 'ppt', 'txt');
        if (in_array($ext, $valid)) {
            return true;
        } else {
            return false;
        }
    }
    public function upload_file($source, $destination)
    {
        $upload = move_uploaded_file($source, $destination);
        return $upload;
    }
    public function remove_file($path)
    {
        $remove = unlink($path);
        return $remove;
    }
    public function get_total_rows($tbl_name, $conn)
    {
        $query = "SELECT * FROM $tbl_name";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $rows = mysqli_num_rows($res);
        return $rows;
    }
    public function get_student_id($tbl_name, $username, $conn)
    {
        $query = "SELECT student_id FROM $tbl_name WHERE username='$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);
        $student_id = $row['student_id'];
        return $student_id;
    }
    public function get_subject($tbl_name, $student_id, $conn)
    {
        $query = "SELECT subject_id FROM $tbl_name WHERE student_id='$student_id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);
        $subject_id = $row['subject_id'];
        return $subject_id;
    }
    public function get_fullname($tbl_name, $student_id, $conn)
    {
        $query = "SELECT first_name,last_name FROM $tbl_name WHERE student_id='$student_id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $full_name = $first_name . ' ' . $last_name;
        return $full_name;
    }
    public function get_subject_name($tbl_name, $subject_id, $conn)
    {
        $query = "SELECT subject_name FROM $tbl_name WHERE subject_id='$subject_id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);
        $subject_name = $row['subject_name'];
        return $subject_name;
    }
}
