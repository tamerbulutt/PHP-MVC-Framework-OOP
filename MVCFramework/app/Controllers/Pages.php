<?php

class Pages extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $this->view('index');
    }

    public function aboutUs()
    {
        //users dizisine modelden verileri çekiyoruz.
        $users = $this->userModel->getUsers();

        $data = [
            'title' => 'Tüm kullanıcılarımız aşağıdadır!',
            'users' => $users
            ];
        //View'ımızı çağırıp içine data dizisini atıyoruz.
        $this->view('about_us',$data);
    }

}
