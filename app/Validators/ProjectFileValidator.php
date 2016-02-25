<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

	protected $rules = [
		'name' => 'required|max:255',
		'file' => 'required',
		'project_id' =>'required',
		'description' => 'required'
	];
}