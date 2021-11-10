<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Traits\DataTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;

class UserController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->getModel('User');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //
        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $this->createSingleRecord($this->model, $request->all());
        return redirect('/user')->with(['message'=>'Create Successful']);
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
        $user = $this->getSigleRecord($this->model, $id);
        return view('user.edit', compact('user'));
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
        $this->updateById($this->model,$id,$request->all());
        return redirect('/user'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteById($this->model, $id);
        return redirect('/user');
    }
    public function initDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->model::query()->with('role');
            $json =   DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'user']);
                })
                ->addColumn('role_name', function ($row) {
                    return !empty($row->role) ? $row->role->role_name : '';
                })
                ->rawColumns(['action', 'role_name'])
                ->make(true);
            return $json;
        }
    }
}
