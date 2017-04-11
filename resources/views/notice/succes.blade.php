<!-- Success -->
@if(\Session::has('success'))
    <div class="alert alert-info" role="alert">
        {{ \Session::get('success') }}
    </div>
@endif