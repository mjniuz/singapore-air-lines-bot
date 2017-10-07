@extends('frontend.layouts.master')

@section('script')
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
        //Timepicker
        $(".timepicker").timepicker({
          use24hours: true,
          showInputs: false
        });
  });
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
</script>
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="style">
                      <div id="title">
                        {{ Input::get('searchlocationfrom')?: null }} 
                        <img src="{{ URL('assets/img/pesawat.png') }}" width="5%">
                        {{ Input::get('searchlocationto')?: null }}
                      </div>
                    </div>
                    {!! Form::open(['role' => 'form', 'route' => 'frontend.flights', 'method' => 'GET']) !!}
                      <div class="col-md-4">
                        <hr>
                        {{ Input::get('searchdate')?: null }} | 1 Adult | Business
                      </div>
                      <div class="col-md-4">
                      <hr>
                        {!! Form::text('searchdate', Input::get('searchdate')?: null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Searching By Date']) !!}
                        {!! Form::hidden('searchlocationfrom', Input::get('searchlocationfrom')?: null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Searching By Date']) !!}
                        {!! Form::hidden('searchlocationto', Input::get('searchlocationto')?: null, ['class' => 'form-control datepicker', 'data-date-format' => 'yyyy-mm-dd', 'placeholder' => 'Searching By Date']) !!}
                      </div>
                      <div class="col-md-4">
                      <hr>
                        {!! Form::submit('Search',['class'=>'btn btn-primary btn-block', 'width' => '1000px', 'height' => '1000px']) !!}
                      </div>
                      <br><br>
                    {!! Form::close() !!}
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <td align="center"><b>
                              Airlines
                          </b></td>
                          <td align="center"><b>
                              Depart
                          </b></td>
                          <td align="center"><b>
                              Arrive
                          </b></td>
                          <td align="center"><b>
                              Duration
                          </b></td>
                          <td align="center"><b>
                              Facility
                          </b></td>
                          <td align="center"><b>
                              Price Per Person
                          </b></td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($flights as $key => $flight)
                          <tr>
                            <td align="center">
                                {{-- <img src="{{ URL('assets/img/singapore-airlines.jpg') }}" width="100px" height="100px" style="display: block;"> --}}
                                <img src="https://lunardream.files.wordpress.com/2012/01/singapore-airlines-mobile.png" width="100px" height="100px" style="display: block;">
                                <b>
                                  Singapore Airlines
                                </b>
                            </td>
                            <td align="center">
                              {{ $flight->only_time }} <br>
                              {{ $flight->from_location }} <br>
                              ( {{ $flight->from_code }} )
                            </td>
                            <td align="center">
                              {{ $flight->only_time_arrival }} <br>
                              {{ $flight->to_location }} <br>
                              ( {{ $flight->to_code }} )
                            </td>
                            <td align="center">
                              {{ ($flight->convert_time) }}
                            </td>
                            <td align="center">
                              <span class="glyphicon glyphicon-briefcase"></span>
                              <span class='glyphicon glyphicon-cutlery'></span>
                              <span class='glyphicon glyphicon-bed'></span>
                            </td>
                            <td align="center">{{ $flight->format_rupiah }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection