<?php
    session_start();
    if($_SESSION['id'] == null) {
        header('Location: index.php');
    }

    require_once '../vendor/autoload.php';
    $login = new App\classes\Login();
    $category = new App\classes\Category();

    $id = $_GET['id'];
    $queryResult = $category->getCategoryInfoById($id);
    $manage =mysqli_fetch_assoc($queryResult);

    $message = "";
    if(isset($_POST['btn'])) {
        $message = $category->updateCategoryInfoById($_POST);
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
        <div class="col-sm-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 style="color: green; "><?php echo $message; ?></h3>
                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="category_name" value="<?php echo $manage['category_name']; ?>">
                                <input type="hidden" class="form-control" name="category_id" value="<?php echo $manage['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Category Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="category_description">
                                    <?php echo $manage['category_description']; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Publication Status</label>
                            <div class="col-sm-9">
                                <input type="radio" name="status" value="0">Published
                                <input type="radio" name="status" value="1">Unpublished
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success btn-block" name="btn">Update Category Info</button>
                            </div>
                        </div>
                    </form>
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

