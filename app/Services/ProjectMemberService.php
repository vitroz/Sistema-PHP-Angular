<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{

	protected $repository;
	protected $validator;

	public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
	{

		$this->repository = $repository;
		$this->validator = $validator;

	}

	public function create(array $data)
	{
		try
		{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);

		}
		catch(ValidatorException $e)
		{
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
		

	}

	public function update(array $data, $id)
	{
		try
		{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);

		}
		catch(ValidatorException $e)
		{
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}



}