@extends('app')

@section('title','Permission Management')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <permission-list :permissions='{{ json_encode($permissionList) }}'></permission-list>
</div>
@endsection