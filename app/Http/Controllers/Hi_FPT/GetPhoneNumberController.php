<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Contract\Hi_FPT\GetPhoneNumberInterface;
use App\DataTables\Hi_FPT\GetPhoneNumberDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\GetPhoneNumberRequest\StoreRequest;
use App\Http\Requests\GetPhoneNumberRequest\UpdateRequest;
use Illuminate\Http\Request;

class GetPhoneNumberController extends BaseController
{
    private $GetPhoneNumberRepository;

    public function __construct(GetPhoneNumberInterface $GetPhoneNumberRepository)
    {
        parent::__construct();
        $this->title = 'GetPhoneNumber Manage';
        $this->GetPhoneNumberRepository = $GetPhoneNumberRepository;
    }

    public function index()
    {
        return $this->GetPhoneNumberRepository->index();
    }

    public function store(StoreRequest $request)
    {
        $this->addToLog($request);
        return $this->GetPhoneNumberRepository->store($request);
    }
}
