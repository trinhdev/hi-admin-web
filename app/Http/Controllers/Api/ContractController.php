<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contracts;
use App\Models\Customers;
use App\Services\HrService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $data = [];
        if (!empty($request->customer_id)) {
            $customer = Customers::select('phone', 'gender', 'birthday')
                ->where('customer_id', $request->customer_id)
                ->first()->toArray();
            $locations = Contracts::select('contracts.location', 'contracts.location_id', 'contracts.location_code', 'contracts.location_name', 'contracts.location_zone', 'contracts.branch_code', 'contracts.branch_name')
                ->join('customer_contract', 'contracts.contract_id', '=', 'customer_contract.contract_id')
                ->join('customers', 'customer_contract.customer_id', '=', 'customers.customer_id')
                ->where('customers.customer_id', $request->customer_id)
                ->first()->toArray();
            $data['personal_info']['gender'] = $customer['gender'];
            $data['personal_info']['birthday'] = $customer['birthday'];

            //get info Employee

            $hrService = new HrService();
            $token = $hrService->loginHr()->authorization;
            $check_employee = $hrService->getListInfoEmployee([$customer['phone']], $token);
            !empty($check_employee) ? $data['personal_info']['is_employee'] = 1 : $data['personal_info']['is_employee'] = 0;
            if (!empty($data['locations'])) {
                $data['personal_info']['has_contract'] = 1;
            } else {
                $data['personal_info']['has_contract'] = 0;
            }
            $data['locations'] = $locations;
        } else {
            return printJson([], buildStatusObject('INVALID_INPUT'), 'vi');
        }
        if (!empty($data)) {
            return printJson($data, buildStatusObject('HTTP_OK'), 'vi');
        }
        return printJson([], buildStatusObject('INTERNAL_SERVER_ERROR'), 'vi');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
