@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
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