<?php

class HomeModel extends CI_Model {

	public function getData()
	{
		return "Hi HomeModel";
	}

//	сравниваем курс на сайте и в БД и сохранием если он отличается
	private function compareCourse($courseArr)
	{
		$this->db->order_by('id', 'DESC');
		$this->db->select('ccy, base_ccy, buy, sale');
		$this->db->where('ccy', $courseArr['ccy']);
		$query = $this->db->get('course');
//		print_r($query->result()[0]->id);
		$diff = array_diff_assoc((array)$query->result()[0], $courseArr);
//		print_r(count($diff));

		if(count($diff) > 0) {
			$this->db->insert('course', $courseArr);
		}
	}

	public function getApiCourse()
	{
		$cookieTime = 600; /* срок действия в секундах */

		if(!isset($_COOKIE["course"])) {
//			получаем данные из банка
			$data = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11", false);
			$data = json_decode($data, true);

//			выбираем ключи данной валюты
			$keyUSD = array_search('USD', array_column($data, 'ccy'));
			$keyEUR = array_search('EUR', array_column($data, 'ccy'));
//			print_r($data[$keyEUR]);

//			создаем куку данных курса
			echo "Cookie named course is not set! We create COOKIE!!!";
			setcookie("course[USD]", json_encode($data[$keyUSD]), time()+$cookieTime);
			setcookie("course[EUR]", json_encode($data[$keyEUR]), time()+$cookieTime);

//			сравниваем курс на сайте и в БД и сохранием если он отличается
			$this->compareCourse($data[$keyEUR]);
			$this->compareCourse($data[$keyUSD]);
		}
	}

	public function getAllCourses()
	{
//		print_r( $this->db->get('course')->result() );
		return $this->db->get('course')->result();
	}
}
