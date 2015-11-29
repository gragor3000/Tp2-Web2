<?php

class Controller{
	public function model($model)
	{
		require_once '../app/models' . $model . '.php';
		Login("admin@admin.com","123");
	}

	public static function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.php';
	}	
}