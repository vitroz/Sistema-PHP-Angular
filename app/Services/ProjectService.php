<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{

	protected $repository;
	protected $validator;

	public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $projectRepo, ProjectMemberValidator $projectValid)
	{

		$this->repository = $repository;
		$this->validator = $validator;

		$this->projectRepo = $projectRepo;
		$this->projectValid = $projectValid;

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

	public function addMember(array $data, $id)
	{
		try
		{

			$this->projectValid->with($data)->passesOrFail();
			return $this->projectRepo->create($data, $id);

		}
		catch(ValidatorException $e)
		{
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}

	public function removeMember($id)
	{
		try
		{
			return $this->projectRepo->delete($id);

		}
		catch(ValidatorException $e)
		{
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}

	public function isMember($id)
	{
		try
		{
			if($this->projectRepo->find($id))
				return true;
			else
				return false;
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