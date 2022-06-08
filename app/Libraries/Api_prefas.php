<?php

namespace App\Libraries;

/**
 * Undocumented class
 * @author Sergio Garcia Mamani <codegarmaser@gmail.com>
 * 
 */



class Api_prefas
{
	private $idCliente = 'MgUNZkcVA84Rrh1N4xbRd2J9dBKoSoeEEU8cl6of';
	private $claveSecreta = 'aqqiMCDSeEQ9kdtjf8ukoUjfcejZb4IF53RpUuuCqXNK7pV56pCOnQfFgGBtjQulZC0wph8GIoYi5dcJ8oQG6AE3yDCnCJN5mzcla4rzck4kgN3mQn7Y7VEc9zpPfiBE';

	public static $credencialesAfiliado = [
		"id" => "",
		"offerid" => "",
		"mid" => ""
	];

	private $baseUri = 'https://servicioapi.upea.bo/prefas/';

	public function __construct()
	{
	}

	public function postulante($idPostulante)
	{
		// $options = [
		// 	'baseURI' => $this->baseUri
		// ];
		// $metodo = 'postulante/id/' . $idPostulante;

		// $client = \Config\Services::curlrequest($options);
		// $respuestaApi = $client->request('GET', $metodo, [
		// 	// 'auth' => [$this->idCliente, $this->claveSecreta]
		// ]);

		$client = \Config\Services::curlrequest([
			'baseURI' => $this->baseUri,
		]);
		
		$estadoError = $client->request('GET', '/status/500', ['http_errors' => false]);

		$respuestaApi = $client->get('postulante/id/' . $idPostulante);

		

		// dd($estadoError->getStatusCode());

		if ($estadoError->getStatusCode() == 500) {
			return false;
		} else {

			// dd($respuestaApi->getStatusCode());
			switch ($respuestaApi->getStatusCode()) {
				case 200:
					$response = $respuestaApi->getBody();
					// d($response);
					break;
				case 500:
					exit('Error 500');
					break;
				case 404:
					return false;
					break;

				default:
					exit('Error garmaser');
					break;
			}
			$respuesta = json_decode($response);

			return $respuesta;
		}
	}








	public function cursos($page = 1, $page_size = 15, $type, $category, $price, $language, $ordering)
	{
		//$urlApi = "https://www.udemy.com/api-2.0/courses/?page=".$page."&page_size=".$page_size."&".$type."=".$category."&price=".$price."&is_affiliate_agreed=True&is_fixed_priced_deals_agreed=True&is_percentage_deals_agreed=True&language=".$language."&ordering=".$ordering;

		$options = [
			'baseURI' => 'https://www.udemy.com/api-2.0/'
		];
		$metodo = 'postulante';
		$query = [
			$type => urldecode($category),
			'page' => $page,
			'page_size' => $page_size,
			'price' => $price,
			'is_affiliate_agreed' => True,
			'is_fixed_priced_deals_agreed' => True,
			// 'is_percentage_deals_agreed'=>True,
			'language' => $language,
			'ordering' => $ordering
		];


		$client = \Config\Services::curlrequest($options);
		$issues = $client->request('GET', $metodo, [
			'query' => $query,
			'auth' => [$this->idCliente, $this->claveSecreta]
		]);

		switch ($issues->getStatusCode()) {
			case 200:
				$response = $issues->getBody();
				// d($response);
				break;
			case 500:
				exit('Error 500');
				break;

			default:
				exit('Error garmaser');
				break;
		}

		$respuesta = json_decode($response);

		return $respuesta;
		// }	   
	}

	public function detalle_curso($idCurso)
	{

		$options = [
			'baseURI' => 'https://www.udemy.com/api-2.0/'
		];
		$metodo = 'courses/' . $idCurso;

		$client = \Config\Services::curlrequest($options);
		$respuestaApi = $client->request('GET', $metodo, [
			'auth' => [$this->idCliente, $this->claveSecreta]
		]);

		switch ($respuestaApi->getStatusCode()) {
			case 200:
				$response = $respuestaApi->getBody();
				d($response);
				break;
			case 500:
				exit('Error 500');
				break;

			default:
				exit('Error garmaser');
				break;
		}
		$respuesta = json_decode($response);

		return $respuesta;
		// }	   
	}





	public function cursossss($page, $page_size, $type, $category, $price, $language, $ordering)
	{

		$autorizacion = base64_encode($this->idCliente . ':' . $this->claveSecreta);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://www.udemy.com/api-2.0/courses/?page=" . $page . "&page_size=" . $page_size . "&" . $type . "=" . $category . "&price=" . $price . "&is_affiliate_agreed=True&is_fixed_priced_deals_agreed=True&is_percentage_deals_agreed=True&language=" . $language . "&ordering=" . $ordering,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_SSL_VERIFYPEER => false, //Deshabilitar verificacion ssl  
			CURLOPT_HTTPHEADER => array(
				"accept: application/json, text/plain, */*",
				"authorization: Basic " . $autorizacion,
				"cache-control: no-cache",
				"content-type: application/json;charset=utf-8",
				"postman-token: b85ac802-45d9-9b21-4b0d-03e93bb17a1d"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {

			// echo $response;

			$respuesta = json_decode($response);

			return $respuesta;
		}
	}

	public function url_cursos()
	{

		if (empty(self::$credencialesAfiliado['id'])) {
			$url = 'https://www.udemy.com{url}';
		} else {
			$url = 'https://click.linksynergy.com/link?id=' . self::$credencialesAfiliado["id"] . '&offerid=' . self::$credencialesAfiliado["offerid"] . '.{id}&type=2&murl=https%3A%2F%2Fwww.udemy.com{url}';
		}
		return $url;
	}

	public static function url_udemy()
	{
		if (empty(self::$credencialesAfiliado['id'])) {
			$url =  'https://www.udemy.com';
		} else {
			$url =  'https://click.linksynergy.com/fs-bin/click?id=' . self::$credencialesAfiliado["id"] . '&offerid=' . self::$credencialesAfiliado["offerid"] . '.81&type=3&subid=0';
		}
		return $url;
	}
}
