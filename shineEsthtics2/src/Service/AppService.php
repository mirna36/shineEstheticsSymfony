<?php


namespace App\Service;


class AppService
{
    public static function capitalize(string $mot){
        return ucwords(mb_strtolower(trim($mot)));
}
    public static function uppercase(string $mot){
        return mb_strtoupper(trim($mot));
    }
    public static function concatene(string $prenom, string $nom){
        return self::capitalize($prenom)." ".self::capitalize($nom);
    }
    public static function lowercase(string $mot){
        return mb_strtolower(trim($mot));
    }
}