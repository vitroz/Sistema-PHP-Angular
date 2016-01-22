<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{

	protected $repository;
	protected $validator;

	public function __construct(ClientRepository $repository, ClientValidator $validator)
	{

		$this->repository = $repository;
		$this->validator = $validator;

	}

	public function create(array $data)
	{
		try
		{
			$this->validator->with($data)->passesOrFail();
			$this->repository->create($data);

			return response()->json(['success' => 'Cliente Cadastrado com Sucesso']);

		}
		catch(ValidatorException $e)
		{
			return [
				'erro' => true,
				'message' => $e->getMessageBag()
			];
		}
		

	}

	public function update(array $data, $id)
	{
		try
		{
			$this->validator->with($data)->passesOrFail();
			$this->repository->update($data, $id);

			return response()->json(['success' => 'Cliente Atualizado com Sucesso']);

		}
		catch(ValidatorException $e)
		{
			return [
				'erro' => true,
				'message' => $e->getMessageBag()
			];
		}

	}



}