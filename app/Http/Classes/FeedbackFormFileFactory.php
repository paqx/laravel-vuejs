<?php

namespace App\Http\Classes;

use App\Http\Classes\FeedbackFormFactoryInterface;

class FeedbackFormFileFactory implements FeedbackFormFactoryInterface
{
	private $fileName;
	
	private $driver;
	
	public function __construct(string $fileName, string $driver = 'local') 
	{
		$this->fileName = $fileName;
		$this->driver = $driver;
	}
			
	public function create(): FeedbackFormInterface
	{
		return new FeedbackFormFile($this->fileName, $this->driver);
	}
}