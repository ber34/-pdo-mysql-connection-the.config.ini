 </php
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
    
    
}
