<?php
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/';
    var_dump($_FILES);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid() . '.' . $extension;

    $authorizedExtension = ['jpg', 'jpeg', 'png'];

    $maxFileSize = 1000000;

    if((!in_array($extension, $authorizedExtension))) {
        $errors [] = 'Veuillez mettre un fichier avec une extension jpg, jpeg ou png';
    }

    if(file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors [] = 'Le fichier doit faire moins de 2M';
    }

    if(empty($errors)) {
        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

        if($result) {
            echo "good";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" enctype="multipart/form-data" method="POST">
        <label for="avatar">ajouter un fichier</label>
        <input type="file" id="avatar" name="avatar">
        <button>Envoyer</button>
    </form>
</body>
</html>