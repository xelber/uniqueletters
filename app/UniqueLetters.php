<?php


namespace App;


class UniqueLetters
{

    /**
     * @param string $word Word.
     * @return boolean
     */
    static function check(string $word)
    {
        $word = strtolower($word);
        $word = preg_replace('/[^\da-z]/i', '', $word);
        $arr = [];
        for ( $i = 0; $i < strlen($word); $i++ )
        {
            if ( !empty( $arr[$word[$i]] ) ) return false;

            $arr[$word[$i]] = true;
        }

        return true;
    }
}