@if(($aclCurrentModule->update == 1 || Auth::user()->role_id == config('constants.ADMIN')) && $module!='logactivities')
<a style="float: left; margin-right: 5px" href="/{{$module}}/edit/{{$row->id}}" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
@endif
{{-- @if($module =='roles')
    <a style="float: left; margin-right: 5px" href="/aclrole/edit/{{$row->id}}" class="btn btn-sm fas fa-edit btn-icon bg-black"></a>
@endif --}}
@if($aclCurrentModule->delete == 1 || Auth::user()->role_id ==config('constants.ADMIN'))
<form action="/{{$module}}/destroy/{{$row->id}}" method="POST" onSubmit="if(!confirm('Confirm this action')){return false;}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
</form>
@endif