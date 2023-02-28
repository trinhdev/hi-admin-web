<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Traits\DataTrait;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'List User';
        $this->model = $this->getModel('User');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable, Request $request)
    {
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleList = Roles::get();
        return view('user.edit')->with(['roleList'=>$roleList]);
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
        $this->addToLog(request());
        return redirect()->route('user.index')->withSuccess('Success!');
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
        $roleList = Roles::get();
        $user = $this->getSigleRecord($this->model, $id);
        return view('user.edit', compact('user'))->with(['roleList'=>$roleList]);
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
        $request->validate([
            'password' => 'nullable|min:1',
            'password_confirmation' => 'nullable|same:password'
        ]);
        $request->request->remove('password_confirmation');
        if($request->password != null){
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
        }else{
            $request->request->remove('password');
            $request->request->remove('password_confirmation');
        }
        $this->updateById($this->model,$id,$request->all());
        $this->addToLog($request);
        return redirect()->route('user.index')->withSuccess('Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->deleteById($this->model, $request->id);
        $this->addToLog(request());
        return response()->json(['message' => 'Delete Successfully!']);
    }
    public function initDatatable(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->model::query()->with('role');
            $json =   DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if($row->role_id == ADMIN){
                        return "";
                    }
                    return view('layouts.button.action')->with(['row' => $row, 'module' => 'user']);
                })
                ->editColumn('role_id', function ($row) {
                    return !empty($row->role) ? $row->role->role_name : '';
                })
                ->rawColumns(['action'])
                ->make(true);
            return $json;
        }
    }
}
