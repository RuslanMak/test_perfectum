<?php

class HomeController extends CI_Controller {
	public function index()
	{
		$this->load->model('HomeModel');
//		$data['course'] = $this->HomeModel->getApiCourse();
		$this->HomeModel->getApiCourse();

//		проверяем или кука уже установлена если нет перезагружаем страницу
		if(isset($_COOKIE["course"])) {
			$data['eur'] = json_decode($_COOKIE["course"]["EUR"], true);
			$data['usd'] = json_decode($_COOKIE["course"]["USD"], true);

			$this->load->view('HomeView', $data);
		} else {
//			header("Refresh:0");
//			or
			header("Location: ./");
		}
	}

	public function history()
	{
		$this->load->model('HomeModel');
		$data['courses'] = $this->HomeModel->getAllCourses();
		$this->load->view('HistoryView', $data);
	}
}
