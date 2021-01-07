<div id="remove">
    @foreach ($log as $item)
@if ($item->uname == 'admin')
<div> <b style="color: red"> {{$item->uname}} </b> - @if ($item->action == 'inventory')
    <b style="color: deeppink"> {{$item->action}}</b>
@elseif($item->action == 'import')
    <b style="color: cornflowerblue"> {{$item->action}}</b>
    @else
    <b style="color: darkorange"> {{$item->action}}</b>
@endif - <b style="color: yellowgreen"> {{$item->created_at}}</b>: {{$item->note}}
</div>
@else
<div><b>{{$item->uname}}</b>  - <b style="color: aqua"> {{$item->action}}</b> - <b style="color: yellowgreen">{{$item->created_at}}</b>: {{$item->note}}
</div>
@endif
@endforeach
</div>
