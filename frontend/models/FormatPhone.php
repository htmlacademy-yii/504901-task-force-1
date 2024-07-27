<?php


namespace frontend\models;

class FormatPhone
{
    public static function format($phone)
    {
        if ($phone) {
            preg_match('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', $phone, $matches);
            return "{$matches[1]} ({$matches[2]}) {$matches[3]} {$matches[4]} {$matches[5]}";
        } 
        return '';
    }
}