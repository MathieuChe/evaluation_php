<?php

namespace Simplex\Service;

class Sanitazer
{

    public static function sanitize()
    {
        if (!empty($_GET)) {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        }

        if (!empty($_POST)) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }

        if (!empty($_REQUEST)) {
            self::trimAndFilterRequest($_REQUEST);
        }
        // dump($_POST);
        // dump($_GET);
        // dump($_REQUEST);
    }

    // Pour du récursive il faut faire appel a un passage par référence &
    public static function trimAndFilterRequest(array &$array): array
    {
        array_walk_recursive($array, function (&$value) {
            $value = trim($value);
            $value = filter_var($value, FILTER_SANITIZE_STRING);
        });

        return $array;
    }
}
