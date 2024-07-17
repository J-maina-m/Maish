<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Attendance</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Attendance Record</h2>
    <form method="post" action="">
        Student ID: <input type="number" name="student_id" required><br>
        Date: <input type="date" name="date" required><br>
        Status: 
        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select><br>
        <input type="submit" name="add_attendance" value="Add Attendance">
    </form>

    <?php
    if (isset($_POST['add_attendance'])) {
        $student_id = $_POST['student_id'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        $sql = "INSERT INTO attendance (student_id, date, status) VALUES ('$student_id', '$date', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "New attendance record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Attendance List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM attendance");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['student_id']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td>
                    <a href='attendance_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='attendance_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
