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
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($flights as $key => $flight)
                          <tr>
                            <td align="center">
                                <img src="{{ URL('assets/img/singapore-airlines.jpg') }}" width="100px" height="100px" style="display: block;">
                                <b>
                                  Singapore Airlines
                                </b>
                            </td>
                            <td align="center">{{ $flight->from_location }}</td>
                            <td align="center">{{ $flight->to_location }}</td>
                            <td align="center">
                              {{ ($flight->convert_time) }}
                            </td>
                            <td align="center">Makanan</td>
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