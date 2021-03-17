<?php
//Model ve Viewların Load edilmesi
class Controller{

    public function model($modelName)
    {
        //Modelı dahil ediyoruz.
        require_once '../app/Models/'. $modelName . '.php';
        
        return new $modelName();
    }

    public function view($viewName,$data = [])
    {
        //View'ı dahil ediyoruz.
        if(file_exists('../app/Views/' . $viewName . '.php'))
            require_once '../app/Views/' . $viewName . '.php';
        else
            die('View bulunamadı.');

    }
}