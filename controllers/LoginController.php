<?php

class LoginController extends RenderView{

    public function index(){

        $users = new UserModel();

        $this->loadView('login',[
            'title' => 'Login Page',
            'users' => $users->usersFetch()
        ]);

    }
}
