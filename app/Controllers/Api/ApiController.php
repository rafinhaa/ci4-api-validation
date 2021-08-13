<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function listUsers()
	{
		$usersModel = new \App\Models\UsersModel;
		$data = $usersModel->findAll();
		if(!$data){
			return $this->failNotFound('No users found!'); //404
		}
		$response = [
			'status' => 200,
			'error' => false,
			'messages' => 'Users list',
			'data' => $data,
		];
		return $this->respond($response,200); //200 OK
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function singleUser($id = null)
	{
		$usersModel = new \App\Models\UsersModel;
		$data = $usersModel->find($id);
		if(!$data){
			return $this->failNotFound('No user found with id '.$id); //404 user not found
		}
		$response = [
			'status' => 200,
			'error' => false,
			'messages' => 'Single user',
			'data' => $data,
		];
		return $this->respond($response,200); //200 OK
	}
	
	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function addUser()
	{
		$rules = [
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email]',				
				'errors' => [
					'required' => 'O e-mail é necessário',
					'valid_email' => 'Você deve inserir um email válido',
					'is_unique' => 'Esse e-mail já está cadastrado',
				],
			],
			'username' => [
				'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',				
				'errors' => [
					'required' => 'Nome de usuário é necessário',
					'alpha_numeric_space' => 'Não pode conter caracteres não alfanuméricos',
					'min_length' => 'O usuário deve conter pelo menos 3 caracteres',
					'max_length' => 'O usuário não pode ultrapassar 30 caracteres',
					'is_unique' => 'Nome de usuário já cadastrado',
				],
			],
		];
		if (! $this->validate($rules)){
			$response = [
				'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
				'data' => [],
			];
			return $this->respond($response,500); //500 Internal Server Error
		}
		$usersModel = new \App\Models\UsersModel;
		$data = [
			'username' => $this->request->getVar('username'),
			'email' => $this->request->getVar('email'),
		];
		if($usersModel->save($data)){
			$response = [
				'status' => 201,
				'error' => false,
				'message' => 'Added user with id ' . $usersModel->getInsertID(),
				'data' => []
			];
			return $this->respondCreated($response); //201 Created
		}
		$response = [
			'status' => 500,
			'error' => true,
			'message' => [
				'error' => 'Error saving user',
			],
			'data' => [],
		];
		return $this->respond($response,500); //500 Internal Server Error
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function updateUser($id = null)
	{
		$rules = [
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email]',				
				'errors' => [
					'required' => 'O e-mail é necessário',
					'valid_email' => 'Você deve inserir um email válido',
					'is_unique' => 'Esse e-mail já está cadastrado',
				],
			],
			'username' => [
				'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',				
				'errors' => [
					'required' => 'Nome de usuário é necessário',
					'alpha_numeric_space' => 'Não pode conter caracteres não alfanuméricos',
					'min_length' => 'O usuário deve conter pelo menos 3 caracteres',
					'max_length' => 'O usuário não pode ultrapassar 30 caracteres',
					'is_unique' => 'Nome de usuário já cadastrado',
				],
			],
		];
		if (! $this->validate($rules)){
			$response = [
				'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
				'data' => [],
			];
			return $this->respond($response,500); //500 Internal Server Error
		}
		$usersModel = new \App\Models\UsersModel;
		if($usersModel->find($id)){		
			$data = [
				'id' => $id,
				'username' => $this->request->getVar('username'),
				'email' => $this->request->getVar('email'),
			];
			if($usersModel->save($data)){
				$response = [
					'status' => 200,
					'error' => false,
					'message' => 'Updated user with id ' . $id,
					'data' => []
				];
				return $this->respondCreated($response); //200 OK
			}						
			$response = [
				'status' => 500,
				'error' => true,
				'message' => [
					'error' => 'Error saving user',
				],
				'data' => [],
			];
			return $this->respond($response,500); //500 Internal Server Error
		}
		return $this->failNotFound('User not found'); //404 Not Found
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function deleteUser($id = null)
	{
		$usersModel = new \App\Models\UsersModel;
		$data = $usersModel->find($id);
		if(!empty($data)){
			if($usersModel->delete($id)){
				$response = [
					'status' => 200,
					'error' => false,
					'messages' => 'User deleted',
					'data' => [],
				];
				return $this->respond($response,200); //200 OK
			}	
			$response = [
				'status' => 500,
				"error" => true,
				'messages' => 'An error happened when deleting the user',
				'data' => []
			];
			return $this->respond($response,500); //500 Internal Server Error		
		}
		return $this->failNotFound('No user found'); //404 Not Found
	}
}
