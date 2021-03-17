<?php

class Database{

    private $dbHost = DB_HOST;  
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try { //PDO bağlantısını gerekli parametreleri verip yapıyoruz.
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) { //Hata oluşursa hata mesajı yazdırıyoruz.
            $this->error = $e->getMessage(); 
            echo "Bağlantı sağlanamadı!" . $this->error;
        }
    }

    //SQL Sorgularını yazacağımız method.
    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    //PDO'dan dönecek veriye göre type'ımızı belirliyoruz.
    public function bind($parameters,$value,$type=null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            
            default:
                $type = PDO::PARAM_STR;
                break;
        }
        $this->statement->bindValue($parameters,$value,$type);
    }
    //Gelen SQL sorgusunu execute edeceğimiz fonksiyon.
    public function execute()
    {
        return $this->statement->execute();
    }
    //Sonuçları yazdıracağımız fonksiyon.
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    //Spesifik tek satırlık dönen veriyi yazdıracağımız fonksiyon.
    public function singleRow()
    {
        $this->execute();
        return $this->statemen->fetch(PDO::FETCH_OBJ);
    }
    //Bulunan sonucun satır sayısı , (kaç adet olduğu) fonksiyon.
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}