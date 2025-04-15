<?php
namespace MyApp\Config;

class Conf
{
    public static $DB_HOST = 'localhost';
    public static $DB_NAME = 'gorille';
    public static $DB_USER = 'root';
    public static $DB_PASSWORD = '';

    public function appUrl()
    {
        $siteUrl = "http://localhost/chatmvc";
        return $siteUrl;
    }
}

?>
