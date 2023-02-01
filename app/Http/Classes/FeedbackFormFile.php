<?php

namespace App\Http\Classes;

use App\Http\Classes\FeedbackFormInterface;
use Illuminate\Support\Facades\Storage;

class FeedbackFormFile implements FeedbackFormInterface
{
	const SEPARATOR = ';';
			
	private $fileName; 
	
	private $driver;
			
	public function __construct(string $fileName, string $driver) 
	{
		$this->fileName = $fileName;
		$this->driver = $driver;
	}
	
	public function save(array $input)
	{
		$contents = '';
		
		foreach ($input as $key => $value) {
			if ($key == array_key_last($input)) {
				$contents .= $value; 
			} else {
				$contents .= $value . self::SEPARATOR;
			}
		}

		Storage::disk($this->driver)->append($this->fileName, $contents);
	}
}