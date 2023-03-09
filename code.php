<?php

require 'db_connect.php';

if(isset($_POST['save_teacher']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $Subject = mysqli_real_escape_string($con, $_POST['Subject']);
    $date_hired = mysqli_real_escape_string($con, $_POST['date_hired']);

    if($name == NULL || $email == NULL || $Subject == NULL || $date_hired == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO teacher (name,email,Subject,date_hired) VALUES ('$name','$email','$Subject','$date_hired')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Teacher Details Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Teacher Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_teacher']))
{
    $teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $Subject = mysqli_real_escape_string($con, $_POST['Subject']);
    $date_hired = mysqli_real_escape_string($con, $_POST['date_hired']);

    if($name == NULL || $email == NULL || $Subject == NULL || $date_hired == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required
            
            
            '
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE teacher SET name='$name', email='$email', Subject='$Subject', date_hired='$date_hired' 
                WHERE id='$teacher_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Teacher Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Teacher Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['teacher_id']))
{
    $teacher_id = mysqli_real_escape_string($con, $_GET['teacher_id']);

    $query = "SELECT * FROM teacher WHERE id='$teacher_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $teacher = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Teacher Fetch Successfully by id',
            'data' => $teacher
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Teacher Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_teacher']))
{
    $teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);

    $query = "DELETE FROM teacher WHERE id='$teacher_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Teacher Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Teacher Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>