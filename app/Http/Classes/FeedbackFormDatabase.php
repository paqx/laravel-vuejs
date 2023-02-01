<?php

namespace App\Http\Classes;

use App\Http\Classes\FeedbackFormInterface;
use Illuminate\Database\Eloquent\Model;

class FeedbackFormDatabase implements FeedbackFormInterface
{
	private $model; 
			
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	public function save(array $input)
	{
		foreach ($input as $key => $value) {
			$this->model->{$key} = $value;
		}

		$this->model->save();
	}
}