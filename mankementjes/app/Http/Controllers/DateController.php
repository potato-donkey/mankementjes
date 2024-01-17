<?php

namespace App\Http\Controllers;

class DateController extends Controller
{
    public static function renderFullDate($date) // FIXME: Make this more elegant
    {
        $rawString = date('j F Y', strtotime($date));
        $rawString = str_replace('January', 'januari', $rawString);
        $rawString = str_replace('February', 'februari', $rawString);
        $rawString = str_replace('March', 'maart', $rawString);
        $rawString = str_replace('April', 'april', $rawString);
        $rawString = str_replace('May', 'mei', $rawString);
        $rawString = str_replace('June', 'juni', $rawString);
        $rawString = str_replace('July', 'juli', $rawString);
        $rawString = str_replace('August', 'augustus', $rawString);
        $rawString = str_replace('September', 'september', $rawString);
        $rawString = str_replace('October', 'oktober', $rawString);
        $rawString = str_replace('November', 'november', $rawString);
        $rawString = str_replace('December', 'december', $rawString);
        return $rawString;
    }
}