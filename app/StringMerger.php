<?php


namespace App;


class StringMerger
{

    public static function merge($str1, $str2)
    {
        $output = '';
        $length1 = strlen($str1);
        $length2 = strlen($str2);
        for ( $i = 0; $i < $length1 && $i < $length2 ; $i++ )
        {
            $output .= $str1[$i].$str2[$i];
        }

        if ( $length1 > $length2 ) // First word is longer
        {
            $output .= substr($str1, $i);
        } elseif ( $length1 < $length2 ) { // elseif as we ignore equal case
            $output .= substr($str2, $i);
        }

        return $output;
    }
}