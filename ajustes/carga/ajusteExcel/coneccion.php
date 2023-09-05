<?php 
    class Db{
        private static $conexion=null;
        
        private function __construct(){}
        
        public static function conectar(){
            self::$conexion=mysqli_connect("localhost","root","","deprove");
        //    self::$conexion=mysqli_connect("sql818.main-hosting.eu","u642438800_deprove","DeproveSac@1234567_","u642438800_deprove");
            return self::$conexion;
        }
    }
?>