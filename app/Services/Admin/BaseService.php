<?php
namespace App\Services\Admin;
use App\Jobs\SendEmail;
use Route;

class BaseService
{

    public function sendSystemErrorMail($mail,$e)
    {
        $exceptionData = [
            'method' => Route::current()->getActionName(),
            'info' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ];
        dispatch(new SendEmail($mail,$exceptionData));
    }
}