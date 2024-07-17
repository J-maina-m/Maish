<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Class</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Teacher ID: <input type="number" name="teacher_id" required><br>
        <input type="submit" name="add_class" value="Add Class">
    </form>

    <?php
    if (isset($_POST['add_class'])) {
        $name = $_POST['name'];
        $teacher_id = $_POST['teacher_id'];

        $sql = "INSERT INTO classes (name, teacher_id)
                VALUES ('$name', '$teacher_id')";

        if ($conn->query($sql) === TRUE) {
            echo "New class added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Class List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Teacher ID</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM classes");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['teacher_id']."</td>";
            echo "<td>
                    <a href='class_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='class_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
