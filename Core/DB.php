<?php
class DB {
    private static mysqli $mysqli;

    public static function connect() {
        DB::$mysqli = mysqli_connect($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_database'], $GLOBALS['db_port'], $GLOBALS['db_socket']);
    }

    public static function disconnect() {
        DB::$mysqli->close();
    }

    public static function query(string $command) : mysqli_result {
        $result = DB::$mysqli->query($command);
        return $result;
    }

    public static function execute(string $command) : mysqli {
        DB::$mysqli->query($command);
        return DB::$mysqli;
    }
}