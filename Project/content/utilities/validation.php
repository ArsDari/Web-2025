<?php

function validateId($id)
{
    if (is_numeric($id))
    {
        if ($id > 0)
        {
            return true;
        }
    }
    return false;
}

function validateImage($type, $size)
{
    return true;
}

?>