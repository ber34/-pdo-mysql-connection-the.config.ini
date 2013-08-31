 </php
 /** PHP 5.1
  * @version 1.60
  * @Added support for the Protocol Open Graph Facebook
  * @Added support for the framework Bootstrap 
  * @license Apache License, Version 2.0.
  * @author Adam Berger <ber34@o2.pl>
  * @Site www.joomla-cms.com.pl
  */
  
 class DataBase{
          private $engine;
          private $host;
          private $port;
          private $database;
          private $user;
          private $file;
          private $dns;
          private $DbPrefix = 'prk_';
           
    
    public function __construct(){
     
     try{  
            if(basename('dbconfig.ini'))
             {     
               if($this->file = parse_ini_file('dbconfig.ini', TRUE, INI_SCANNER_NORMAL))
                 {
                   $this->engine   = $this->file['db']['baza']; // np 'mysql'
                   $this->host     = $this->file['db']['host']; // 'localhost'
               $this->port     = $this->file['db']['port']; // '3306'
                   $this->database = $this->file['db']['dbname']; // nazwa bazy danych
                   $this->user     = $this->file['db']['username']; //nazwa uzytkownika
                   $this->pass     = $this->file['db']['password']; // hasło uzytkownika
                  }else{
                    echo 'Otwarcie ' . $this->file . 'Nieudane.';
                 }
             }
 
               if($this->dns = $this->engine.':host='.$this->host.';port='.$this->port.';dbname='.$this->database.';')
                 {     
   parent::__construct($this->dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
                 }
        // echo 'Połączenie nawiązane!';
          }catch(PDOException $e){
                echo 'Połączenie nie mogło zostać utworzone.'.$e->getMessage();
          }
    }
 
 
  
 
public function dbprefix()
    {  
               return $this->DbPrefix;
    } 
    
public function create_table()
   {
          $sql ='SHOW TABLES LIKE :table';
         $stmt = self::__construct()->prepare($sql); /// $this->db
         $stmt->bindValue(':table', 'zarabiarka', PDO::PARAM_STR);
         $stmt->execute();
    if($stmt->fetch() > 0)
       {
             echo 'Tabela istnieje.';     
      }else{
             // echo 'Tabela nie istnieje.';  
         $sql = 'CREATE TABLE IF NOT EXISTS `zarabiarka`('
           .'`id_za` int(11) NOT NULL AUTO_INCREMENT,'
           .'`nick_alegro` varchar(255) NOT NULL,'
           .'`iledni` varchar(55) NOT NULL,'
           .'`email` varchar(70) NOT NULL,'
           .'`nr_transakcji` varchar(255) NOT NULL,'
           .'`kwota_transakcji` varchar(255) NOT NULL,'
           .'`ip` varchar(255) NOT NULL,'
           .'PRIMARY KEY (`id_za`)'
          .') ENGINE=MyISAM  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';

       if(self::__construct()->exec($sql) !== false) // $this->db
           {
           return 1; 
           } else {
            return 0;
          }
      }  
    }
}
