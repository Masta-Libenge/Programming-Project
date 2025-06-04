<!DOCTYPE html>
<html>
<head>
    <title>Student Information Form</title>
</head>
<body>
<h2>Enter Your Information</h2>
<form action="submit.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="field">Field of Study:</label><br>
    <input type="text" id="field" name="field" required><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
<?php
