<?php

function validateId($id)
{
    if (is_numeric($id)) // дополнить
    {
        if ($id > 0)
        {
            return true;
        }
    }
    return false;
}

?>