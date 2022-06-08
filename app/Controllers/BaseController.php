<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use Hashids\Hashids;

// grocery crud
include(APPPATH . 'Libraries/GroceryCrudEnterprise/autoload.php');

use GroceryCrud\Core\GroceryCrud;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var CLIRequest|IncomingRequest
	 */
	protected $request;
	public $session;
	protected $hashids;
	public $idDocente;
	protected $rowDocente;
	public $uploadValidations;
	protected $ionAuth;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['principal'];

	/**
	 * Constructor.
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		$this->ionAuth    = new \IonAuth\Libraries\IonAuth();
		$this->hashids = new Hashids('archivoDocente***544546%&/&%', 15);
		$this->uploadValidations = [
            'maxUploadSize' => '20M', // 20 Mega Bytes
            'minUploadSize' => '1K', // 1 Kilo Byte
            'allowedFileTypes' => [
                'pdf'
            ]
        ];

		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		// Preload any models, libraries, etc, here.

		// E.g.: $this->session = 
		$this->session = \Config\Services::session();
	}

	



	//--------------------------------------------------------------------
	//---- GROCERY CRUD
	//--------------------------------------------------------------------
	protected function _output_grocerycrud($output = null)
	{
		if (isset($output->isJSONResponse) && $output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}

		return view('grocerycrud', (array)$output);
	}

	protected function _output_archivo($output = null)
	{
		if (isset($output->isJSONResponse) && $output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}

		return view('archivoDocente/archivo', (array)$output);
	}

	protected function _getDbData()
	{
		$db = (new \Config\Database())->default;
		return [
			'adapter' => [
				'driver' => 'Pdo_Mysql',
				'host'     => $db['hostname'],
				'database' => $db['database'],
				'username' => $db['username'],
				'password' => $db['password'],
				'charset' => 'utf8'
			]
		];
	}
	protected function _getGroceryCrudEnterprise($bootstrap = true, $jquery = true)
	{
		$db = $this->_getDbData();
		$config = (new \Config\GroceryCrudEnterprise())->getDefaultConfig();

		$groceryCrud = new GroceryCrud($config, $db);
		return $groceryCrud;
	}
}