<!DOCTYPE html>
<html>
<head>
    <title>Image Picker</title>
    <style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
        }
        .image-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function selectImage(imagePath) {
            console.log('selectImage');
            window.opener.setImage(imagePath);
            window.close();
        }
    </script>
</head>
<body>
    <h2>Choose an Image</h2>
    <div class="image-container">
        <?php
            $imageFolder = 'images/uploads';
            $images = scandir($imageFolder);

            foreach ($images as $image) {
                if ($image !== '.' && $image !== '..') {
                    echo '<img src="' . $imageFolder . '/' . $image . '" alt="' . $image . '" onclick="selectImage(\'' . $imageFolder . '/' . $image . '\')">';
                }
            }
        ?>
    </div>
</body>
</html>
