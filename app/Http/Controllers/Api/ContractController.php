<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contracts;
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
        if (!empty($request->id)) {
            $contracts = Contracts::select('contracts.location', 'contracts.location_id', 'contracts.location_code', 'contracts.location_name', 'contracts.location_zone', 'contracts.branch_code', 'contracts.branch_name')
                ->join('customer_contract', 'contracts.contract_id', '=', 'customer_contract.contract_id')
                ->join('customers', 'customer_contract.customer_id', '=', 'customers.customer_id')
                ->where('customers.customer_id', $request->id)
                ->get();
        }

        if (!empty($contracts)) {
            return printJson($contracts, buildStatusObject('HTTP_OK'), 'vi');
        }
        return printJson([], buildStatusObject('HTTP_OK'), 'vi');
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
