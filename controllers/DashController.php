<?php

class DashController extends RenderView{

    public function index(){

    }

    public function show($id){
        $id_user = $id[0];

        $user = new UserModel();

        $this->loadView('dash', ['user' => $user->fetchById($id_user)]);

    }
}
