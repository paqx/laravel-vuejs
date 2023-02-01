<?php

namespace App\Http\Classes;

use App\Http\Classes\FeedbackFormFactoryInterface;
use Illuminate\Database\Eloquent\Model;

class FeedbackFormDatabaseFactory implements FeedbackFormFactoryInterface
{
	private $model;
	
	public function __construct(Model $model, string $connection) 
	{
		$this->model = $model;
		$this->model->setConnection($connection);
	}
			
	public function create(): FeedbackFormInterface
	{
		return new FeedbackFormDatabase($this->model);
	}
}