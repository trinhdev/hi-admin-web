@extends('app')

@section('title','Role Detail')
@section('content')
    <role-detail :rolegroup="{{ json_encode($data['roleDetail']) }}" :users="{{ json_encode($data['users']) }}"></role-detail>
@endsection