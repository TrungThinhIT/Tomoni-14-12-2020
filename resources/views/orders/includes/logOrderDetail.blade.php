<div id="remove">
    @foreach ($log as $item)
@if ($item->uname == 'admin')
<div> <b style="color: red"> {{$item->uname}} </b> - <b style="color: yellowgreen"> {{$item->date}}</b>: {{$item->note}}
</div>
@else
<div><b>{{$item->uname}}</b> - <b style="color: yellowgreen">{{$item->date}}</b>: {{$item->note}}
</div>
@endif
@endforeach
</div>
