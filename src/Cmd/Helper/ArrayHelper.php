<?php declare(strict_types = 1);

namespace Cmd\Helper;

class ArrayHelper
{
    /**
     * Converti un tableau en chaîne affichable
     *
     * @param array $array
     * @return string
     */
    static public function toString(array $array): string
    {
        return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
