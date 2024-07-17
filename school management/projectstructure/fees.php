<?php include('config.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Fees</title>
</head>
<body>
    <?php include('header.php'); ?>
    <h2>Add New Fee Record</h2>
    <form method="post" action="">
        Student ID: <input type="number" name="student_id" required><br>
        Amount: <input type="number" name="amount" required><br>
        Date: <input type="date" name="date" required><br>
        <input type="submit" name="add_fee" value="Add Fee">
    </form>

    <?php
    if (isset($_POST['add_fee'])) {
        $student_id = $_POST['student_id'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];

        $sql = "INSERT INTO fees (student_id, amount, date) VALUES ('$student_id', '$amount', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "New fee record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Fees List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM fees");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['student_id']."</td>";
            echo "<td>".$row['amount']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td>
                    <a href='fees_edit.php?id=".$row['id']."'>Edit</a> |
                    <a href='fees_delete.php?id=".$row['id']."'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php include('footer.php'); ?>
</body>
</html>
