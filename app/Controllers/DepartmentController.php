<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\Facade as RedBean;

class DepartmentController
{
	private $view;

   	public function __construct($container) {
	    $this->view = $container->get('view');
	    $container->get('db'); // initializtion to connect db
   	}

	public function index($request, $response, $args)
	{
		$dep = RedBean::findAll('departments');
		echo $this->view->render('department_index.html', array('dep' => $dep));

		return $response;
	}

	public function show($request, $response, $args)
	{
		$id = $request->getAttribute('id');
		$department = RedBean::load('departments', $id);
		$employees = $department->ownEmployeesList;
		echo $this->view->render('department_show.html', array('department' => $department, 'employees' => $employees));

		return $response;
	}
	
	public function edit($request, $response, $args)
	{
		
	}

	public function update($request, $response, $args)
	{
		
	}

	public function create($request, $response, $args)
	{
		echo $this->view->render('department_create.html');

		return $response;		
	}

	public function store(Request $request, Response $response, $args)
	{
		//var_dump($request);
		$department = RedBean::dispense('departments');
		$data = $request->getParsedBody();
		$department->name = $data['name'];
		$id = RedBean::store($department);

		return header('Location: /departments');
	}

	public function delete($request, $response, $args)
	{
		
	}
}