<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\ResetPasswordWrongInterface;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\ResetPasswordWrongRequest\StoreRequest;


class ResetPasswordWrongController extends BaseController
{
    private $ResetPasswordWrongRepository;

    public function __construct(ResetPasswordWrongInterface $ResetPasswordWrongRepository)
    {
        parent::__construct();
        $this->title = 'Reset Password Wrong';
        $this->ResetPasswordWrongRepository = $ResetPasswordWrongRepository;
    }

    public function index()
    {
        return $this->ResetPasswordWrongRepository->index();
    }

    public function store(StoreRequest $request)
    {
        return $this->ResetPasswordWrongRepository->store($request->all());
    }
}
