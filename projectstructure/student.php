<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Student</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        DOB: <input type="date" name="dob" required><br>
        Gender: <input type="text" name="gender" required><br>
        Address: <input type="text" name="address" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        <input type="submit" name="add_student" value="Add Student">
    </form>

    <?php
    if (isset($_POST['add_student'])) {
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO students (name, dob, gender, address, email, phone)
                VALUES ('$name', '$dob', '$gender', '$address', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "New student added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Student List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['dob']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>
                    <a href='student_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='student_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
