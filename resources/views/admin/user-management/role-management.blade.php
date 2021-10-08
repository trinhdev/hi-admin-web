@extends('app')

@section('title','Role')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <role-management :group='{{ json_encode($roleLists) }}'></role-management>
</div>
@endsection