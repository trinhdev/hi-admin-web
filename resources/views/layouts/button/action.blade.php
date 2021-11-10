<a style="float: left; margin-right: 5px" href="/{{$module}}/edit/{{$row->id}}" class="btn btn-sm fas fa-edit btn-icon bg-olive"></a>
<form action="/{{$module}}/destroy/{{$row->id}}" method="POST" onSubmit="if(!confirm('Confirm this action')){return false;}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
</form>