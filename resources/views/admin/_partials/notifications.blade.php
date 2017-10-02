@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>  <i class="icon fa fa-check"></i> Success!</h4>
      {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>  <i class="icon fa fa-close"></i> Error!</h4>
      {{ Session::get('danger') }}
    </div>
@endif
@if (count($errors) > 0)
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @foreach ($errors->all() as $error)
        {{ $error }}<br/>
    @endforeach
  </div>
@endif
