<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
head>
    <title>Manage Enrollments</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Enrollment</h2>
    <form method="post" action="">
        Student ID: <input type="number" name="student_id" required><br>
        Class ID: <input type="number" name="class_id" required><br>
        <input type="submit" name="add_enrollment" value="Add Enrollment">
    </form>

    <?php
    if (isset($_POST['add_enrollment'])) {
        $student_id = $_POST['student_id'];
        $class_id = $_POST['class_id'];

        $sql = "INSERT INTO enrollments (student_id, class_id) VALUES ('$student_id', '$class_id')";

        if ($conn->query($sql) === TRUE) {
            echo "New enrollment added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Enrollment List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Class ID</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM enrollments");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['student_id']."</td>";
            echo "<td>".$row['class_id']."</td>";
            echo "<td>
                    <a href='enrollment_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='enrollment_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
