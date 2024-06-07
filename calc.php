<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="calculator">
        <h2>PHP Calculator</h2>
        <form method="post">
            <input type="number" name="num1" placeholder="Enter first number" required>
            <input type="number" name="num2" placeholder="Enter second number" required>
            <select name="operation">
                <option value="add">Addition</option>
                <option value="subtract">Subtraction</option>
                <option value="multiply">Multiplication</option>
                <option value="divide">Division</option>
                <option value="exponentiation">Exponentiation</option>
                <option value="percentage">Percentage</option>
                <option value="square_root">Square Root</option>
                <option value="logarithm">Logarithm</option>
            </select>
            <button type="submit" name="submit">Calculate</button>
        </form>
        
        <?php
        if (isset($_POST['submit'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operation = $_POST['operation'];
            $result = "";

            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    if ($num2 == 0) {
                        $result = "Cannot divide by zero!";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                case 'exponentiation':
                    $result = pow($num1, $num2);
                    break;
                case 'percentage':
                    $result = ($num1 / $num2) * 100;
                    break;
                case 'square_root':
                    $result = sqrt($num1);
                    break;
                case 'logarithm':
                    if ($num1 <= 0) {
                        $result = "Logarithm is not defined for non-positive values!";
                    } else {
                        $result = log($num1);
                    }
                    break;
                default:
                    $result = "Invalid operation!";
                    break;
            }
            echo "<h3>Result: $result</h3>";
        }
        ?>
    </div>
</body>
</html>
