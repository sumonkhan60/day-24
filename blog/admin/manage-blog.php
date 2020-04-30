<?php
    session_start();
    if($_SESSION['id'] == null) {
        header('Location: index.php');
    }

    require_once '../vendor/autoload.php';
    $login = new App\classes\Login();
    $info = new App\classes\Info();

    $queryResult = $info->getAllBlogInfo();

    $message = "";
    if(isset($_GET['delete'])) {
        $id = $_GET['id'];
        $message = $info->deleteBlogInfoById($id);
    }

    if(isset($_GET['logout'])) {
        $login->adminLogout();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
</head>
<body>
<?php include 'includes/menu.php'; ?>

<div class="container" style="margin-top: 10px; ">
    <div class="row">
        <div class="col-sm-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Category Id</th>
                            <th>Blog Title</th>
                            <th>Short Description</th>
                            <th>Long Description</th>
                            <th>BLog Image</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($manage = mysqli_fetch_assoc($queryResult)) { ?>
                            <tr>
                                <td><?php echo $manage['id']; ?></td>
                                <td><?php echo $manage['category_id']; ?></td>
                                <td><?php echo $manage['blog_title']; ?></td>
                                <td><?php echo $manage['short_description']; ?></td>
                                <td><?php echo $manage['long_description']; ?></td>
                                <td><?php echo $manage['blog_image']; ?></td>
                                <td><?php echo $manage['status']; ?></td>
                                <td>
                                    <a href="edit-blog.php?id=<?php echo $manage['id']; ?>">Edit</a>
                                    <a href="?delete=true & id=<?php echo $manage['id']; ?>" onclick="return confirm('Are you sure to delete this !!!'); ">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.4.1.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>


