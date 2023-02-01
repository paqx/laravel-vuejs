<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Classes\FeedbackFormFileFactory;
use App\Http\Classes\FeedbackFormDatabaseFactory;
use App\Models\Feedback;

class FeedbackformController extends Controller
{
    public function index() 
	{
		return view('index');
	}
	
	public function submit(Request $request) 
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:3|max:255',
			'phone' => 'required',
			'message' => 'required',
		]);

		if ($validator->fails())
			return response()->json([
				'success' => false,
				'why' => 'validation_failed',
				'validation_messages' => $validator->messages()->toArray(),
			]);
		
		
		$fileName = 'feedback.txt';
		$fileFactory = new FeedbackFormFileFactory($fileName);
		$file = $fileFactory->create('feedback.txt');
		$file->save($validator->validated());
		
		$model = new Feedback();
		$connection = 'mysql';
		$databaseFactory = new FeedbackFormDatabaseFactory($model, $connection);
		$database = $databaseFactory->create();
		$database->save($validator->validated());
		
		return response()->json([
			'success' => true,
			'success_message' => 'Your message has been sent!',
		]);
	}
}
