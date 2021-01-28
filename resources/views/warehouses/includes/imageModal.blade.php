<div class="modal-header">
    <h4 class="modal-title">Hóa đơn </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <div class="col-12">
        <div class="form-row">
            @if(Storage::size('images/'.$img)<=70000) <img style="display:block;margin-left:auto;margin-right:auto"
                src="{{asset('images/'.$img)}}" alt="Hóa đơn" width="300px" height="300px">
                @else{
                <img style="display:block;margin-left:auto;margin-right:auto" src="{{asset('images/'.$img)}}" alt="Hóa đơn"
                    width="700px" height="700px">
                }
                @endif
        </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <div style="float: right;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
