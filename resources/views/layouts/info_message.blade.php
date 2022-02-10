@if(session('error'))
    <div class="col-12">
        <div class="alert alert-danger">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('mensage'))
    <div class="col-12">
        <div class="alert alert-success">
            <strong>{{ session('mensage') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif