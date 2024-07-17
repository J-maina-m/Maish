<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Teachers</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Teacher</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Subject ID: <input type="number" name="subject_id" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        <input type="submit" name="add_teacher" value="Add Teacher">
    </form>

    <?php
    if (isset($_POST['add_teacher'])) {
        $name = $_POST['name'];
        $subject_id = $_POST['subject_id'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO teachers (name, subject_id, email, phone)
                VALUES ('$name', '$subject_id', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "New teacher added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Teacher List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM teachers");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['subject_id']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>
                    <a href='teacher_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='teacher_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
