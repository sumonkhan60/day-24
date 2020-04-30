<?php
    $link = mysqli_connect('localhost', 'root','','image_upload');
    echo '<pre>';
    print_r($_POST);


    if(isset($_POST['btn'])) {

        $fileName = $_FILES['image_file']['name'];
        $directory = 'images/';
        $imageUrl = $directory.$fileName;
        $filetype = pathinfo($fileName, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES['image_file']['tmp_name']);
        if($check) {
            if(file_exists($imageUrl)) {
                die('This file already exist.Please choose another one. Thanks');
            }else {
                if($_FILES['image_file']['size'] > 500000) {
                    die('Your file size is too large. Please select within 10kb');
                }else {
                    if($filetype != 'JPG' && $filetype != 'jpg' && $filetype!= 'png') {
                        die('Image type is not supported.Please use jpg or png. ');
                    }else {
                        move_uploaded_file($_FILES['image_file']['tmp_name'], $imageUrl);
                        $sql = "INSERT INTO images (file_name) VALUES ('$imageUrl') ";
                        mysqli_query($link, $sql);
                        echo 'Image upload and saved successfully';
                    }
                }
            }
        }else {
            die('Please choose an image file thanks !.');
        }
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Select File</th>
            <td><input type="file" name="image_file"></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" name="btn" value="SubmiT"></td>
        </tr>
    </table>
</form>
<hr/>

<?php
    $sql = "SELECT * FROM images";
    $queryResult = mysqli_query($link, $sql);
?>
<table>
    <?php while ($image = mysqli_fetch_assoc($queryResult)) { ?>
    <tr>
        <td><img src="<?php echo $image['file_name']; ?>" alt="" height="100" width="100" /></td>
    </tr>
    <?php }  ?>
</table>

