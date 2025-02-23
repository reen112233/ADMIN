<?php
session_start(); // Start the session for SweetAlert2 notifications
include 'db.php';

// Create
if (isset($_POST['create'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $stmt = $conn->prepare("INSERT INTO admin (fname, lname, email, username, password, usertype) VALUES (:fname, :lname, :email, :username, :password, :usertype)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usertype', $usertype);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'User created successfully!';
    } else {
        $_SESSION['error'] = 'Failed to create user.';
    }
    header("Location: admin.php"); // Redirect to avoid form resubmission
    exit();
}

// Read
$stmt = $conn->prepare("SELECT * FROM admin");
$stmt->execute();
$users = $stmt->fetchAll();

// Update
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

// Delete
if (isset($_GET['delete'])) {
    $UserID = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM admin WHERE UserID = :UserID");
    $stmt->bindParam(':UserID', $UserID);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'User deleted successfully!';
    } else {
        $_SESSION['error'] = 'Failed to delete user.';
    }
    header("Location: admin.php"); // Redirect to avoid form resubmission
    exit();
}
?>