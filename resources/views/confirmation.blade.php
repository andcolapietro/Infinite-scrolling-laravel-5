@if(Session::has('success_message'))
    <div class="alert alert-success" role="alert">
        <strong>{!!  Session::get('success_message') !!}</strong>
    </div>
@endif