<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

h2 {
    width: 100%;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    width: 100%;
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="radio"],
input[type="checkbox"] {
    margin-right: 5px;
}

button {
    text-align: center;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>User Information</h2>
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" name="username" value="<?=$_SESSION['auth_user']['username'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?=$_SESSION['auth_user']['email'] ?>" readonly >
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?=$_SESSION['auth_user']['phone'] ?>" readonly>
            </div>
            <div class="form-group">
                <label>Sex:</label>
                <input type="radio" id="male" name="sex" value="male" required> Male
                <input type="radio" id="female" name="sex" value="female" required>Female
                <input type="radio" id="other" name="sex" value="other" required> Other
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit-update-inforUser">Submit</button>
            </div>
        </form>
    </div>
    <?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>
</body>
</html>
