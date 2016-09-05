<?php

if (!function_exists('str_plural_text')) {
    /**
     * Return the str_plural result with the count before it.
     *
     * Results in a full string such as the following: '16 topics.'
     *
     * @param  string  $text
     * @param  integer  $count
     * @return string
     */
    function str_plural_text($text, $count)
    {
        return $count . ' ' . str_plural($text, $count);
    }
}
