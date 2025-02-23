<?php include 'crud.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="main-container">
        <!-- Side Menu -->
        <div class="side-menu">
            <div class="brand-name">
                <h6>BoardLinker Admin</h6>
            </div>
            <ul>
                <br><br>
                <li><a href=""><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href=""><i class="fas fa-user-shield"></i> Admin</a></li>
                <li><a href=""><i class="fas fa-question-circle"></i> Help</a></li>
                <li><a href=""><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href=""><i class="fas fa-sign-out-alt"></i> Log out</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="child-container">
            <div class="header">
                <div class="nav">
                    <!-- Navigation content here -->
                </div>
            </div>

            <!-- Admin Dashboard Content -->
            <h1>Admin Dashboard</h1>

            <!-- Create User Form -->
            <form method="POST">
                <input type="text" name="fname" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="username" name="username" placeholder="Username" required>
                <select name="usertype" id="usertype" placeholder = "User Type">
                    <option value="Property Owner">Property Owner</option>
                    <option value="Renter">Renter</option>
                </select>
                <button type="submit" name="create">Add User</button>
            </form>

            <!-- Display Users Table -->
            <table border="4">
                <tr>
                    <th>UserID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['UserID']; ?></td>
                    <td><?php echo $user['fname']; ?></td>
                    <td><?php echo $user['lname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['usertype']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <a href="edit.php?UserID=<?php echo $user['UserID']; ?>">Edit</a>
                        <a href="admin.php?delete=<?php echo $user['UserID']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['success']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?php echo $_SESSION['error']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
    </script>
</body>
</html>