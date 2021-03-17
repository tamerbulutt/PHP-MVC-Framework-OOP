<?php

class Core{
    //Varsayılan controller , method ve parametlerimizi belirliyoruz.
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if(file_exists('../app/Controllers/' . ucwords($url[0]) . '.php'))
        {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);          
        }     

        //Controllerımızı dahil ediyoruz.    
        require_once '../app/Controllers/' . $this->currentController . '.php';
        //Controller classımızın nesnesini oluşturuyoruz.   
        $this->currentController = new $this->currentController;
    
        if(isset($url[1]))
        {
            if(method_exists($this->currentController , $url[1]))
            {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        //Eğer parametre içeriyorsa::
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController , $this->currentMethod],$this->params);
    }
    //URL Parse işlemleri
    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'],'/'); //Url'in sonundaki "/" ı siler.
            $url = filter_var($url , FILTER_SANITIZE_URL); //$#½ tarzı harfleri filtreler.
            $url = explode("/",$url); // "/"lara göre bölüp dizi haline getirdi.
 
            return $url;
        }
    }
}