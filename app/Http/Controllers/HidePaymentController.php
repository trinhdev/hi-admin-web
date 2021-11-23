<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use App\Services\ApiService;
use Illuminate\Support\Facades\RateLimiter;

class HidePaymentController extends MY_Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        dd('26 - Hidepayment controller');
    }

    public function index()
    {
        $hidepayment = new stdClass();
        $hidepayment->versions = ['6.2.1'];
        return view('hidepayment.hide')->with('hidepayment', $hidepayment);
    }

    public function hide(Request $request) {
        $executed = RateLimiter::attempt(
            'hide-payment' . $request['version'],
            $perMinute = 2,
            function() {
                
            }
        );
        if (! $executed) {
            return view('error419');
        }

        $validated = $request->validate([
            'version' => 'required',
        ]);
        $request->merge([
            'isUpStoreAndroid' => (!isset($request->isUpStoreAndroid)) ? "0" : "1",
            'isUpStoreIos' => (!isset($request->isUpStoreIos)) ? "0" : "1",
        ]);

        $data = ApiService::hidePayment($request->all());

        if(!empty($data['status'])) {
            $result = ['success' => 'success', 'html' => $data['message']];
        }
        else {
            $result = ['error' => 'error', 'html' => $data['message']];
        }
        return redirect('/hidepayment')->with($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
