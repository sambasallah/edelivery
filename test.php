<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="uploadFile">
    <input type="submit" value="upload">
</form>

<?php 


if($_SERVER['REQUEST_METHOD'] == "POST") {
    echo var_dump($_FILES['uploadFile']);
}