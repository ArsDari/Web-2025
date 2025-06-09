<?php

include '../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

if (isset($_POST))
{
    try
    {
        $path = $_FILES['image']['tmp_name'];
        $image = $_FILES['image']['name'];
        foreach ($path as $key => $element)
        {
            if (!move_uploaded_file($element, 'content/media/images/' . $image[$key]))
            {
                
            }
        }
        savePostToDatabase($connection, $_POST, $image);
    }
}

?>