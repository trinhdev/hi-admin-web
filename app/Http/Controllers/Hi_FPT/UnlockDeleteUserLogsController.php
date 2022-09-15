<?php

namespace App\Http\Controllers\Hi_FPT;
use App\DataTables\Hi_FPT\UnlockDeleteUserLogsDataTable;
use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;
use App\Services\AuthApiService;
use Illuminate\Support\Facades\RateLimiter;

class UnlockDeleteUserLogsController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->title = 'Unlock delete user logs';
        $this->model = $this->getModel('Unlock_Delete_User_Logs');
        parent::__construct();
    }
    public function index(UnlockDeleteUserLogsDataTable $dataTable, Request $request)
    {
        return $dataTable->with([
            'start'     => $request->start,
            'length'    => $request->length,
            'order'     => $request->order,
            'columns'   => $request->columns,
            ])->render('unlock_delete_user_logs.index');
    }

    public function handle(UnlockDeleteUserLogsDataTable $dataTable, Request $request) {
        $executed = RateLimiter::attempt(
            'request-otp-with-phone' . $request['phone'],
            $perMinute = 2,
            function() {
                
            }
        );
        
        if (! $executed) {
            abort(429);
        }

        $validated = $request->validate([
            'phone' => 'required|digits_between:10,11',
        ]);

        $result = [];

        $authApiService = new AuthApiService();
        $data = json_decode(json_encode($authApiService->reset_delete_user(["phone" => $request["phone"]])), true);

        if(isset($data['statusCode'])) {
            if($data['statusCode'] == 0) {
                $result = ['success' => 'success', 'html' => $data['message'], 'message' => $data['message'], 'status' => $data['statusCode']];
                $request->session()->flash('success', 'success');
                $request->session()->flash('html', $data['message']);
            }
            else {
                $result = ['error' => 'error', 'html' => $data['message'], 'message' => $data['message'], 'status' => 0];
                $request->session()->flash('error', 'error');
                $request->session()->flash('html', $data['message']);
            }
        }
        else {
            $result = ['error' => 'error', 'html' => $data['message'], 'message' => $data['message'], 'status' => 0];
            $request->session()->flash('error', 'error');
            $request->session()->flash('html', $data['message']);
        }
        
        $result['phone'] = $request['phone'];
        $log_data = [
            'phone'         => $request['phone'],
            'result_status' => $result['status'],
            'api_result'    => json_encode($data),
            'message'       => $result['message'],
            'createdBy'     => $this->user->id
        ];
        $this->model->create($log_data);
        $this->addToLog($request);
        return redirect()->route('unlockdeleteuser.index');
    }
}
