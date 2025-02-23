<?php
session_start();
include 'db.php';

if (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->execute();
    $user = $stmt->fetch();
}

if (isset($_POST['update'])) {
    $UserID = $_POST['UserID'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $stmt = $conn->prepare("UPDATE admin SET username = :username, email = :email, password = :password, usertype = :usertype WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usertype', $usertype);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = 'User updated successfully!';
    } else {
        $_SESSION['error'] = 'Failed to update user.';
    }
    header("Location: admin.php"); // Redirect to avoid form resubmission
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form method="POST">
        <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
        <input type="text" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>"placeholder="Email" required>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" placeholder="Password" required>
        <select name="usertype" value="<?php echo $user['usertype']; ?>" required>
            <option value="Property_Owner">Propert Owner</option>
            <option value="Renter">Renter</option>
            </select>
        <button type="submit" name="update">Update User</button>
    </form>
</body>
</html>