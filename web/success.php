<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userIdentifier = $_POST['user_identifier'];
    if (!empty($userIdentifier)) {
        $command = escapeshellcmd("./flag.sh -p " . $userIdentifier);
        $output = shell_exec($command);
        echo "<pre>$output</pre>";
    } else {
        echo "User identifier is required.";
    }
} else {
    echo "Invalid request method.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Congratulations</title>
</head>
<body>
    <h2>Success</h2>
    <form method="post">
        User Identifier: <input type="text" name="user_identifier"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
