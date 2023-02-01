<?php

namespace App\Http\Classes;

use App\Http\Classes\FeedbackFormInterface;

interface FeedbackFormFactoryInterface
{
	public function create(): FeedbackFormInterface;
}