@php
$method = strtolower($row->method);
@endphp
@if($method =='get')
<label class="badge badge-info">GET</label>
@elseif($method == 'post' )
<label class="badge badge-success">POST</label>
@elseif($method == 'delete')
<label class="badge badge-danger">DELETE</label>
@elseif( $method =='put')
<label class="badge badge-warning">PUT</label>
@else
<label class="badge badge-primary">{{$row->method}}</label>
@endif