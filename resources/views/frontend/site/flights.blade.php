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
                          <th>No.</th>
                          <th>Format</th>
                          <th>Example</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($flights as $key => $flight)
                          <tr>
                            <td align="center">
                                {{ ($flights->currentpage()-1) * $flights->perpage() + $key + 1 }}
                            </td>
                            <td>{{ $flight->format_chat }}</td>
                            <td>{{ $flight->example_chat }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {!! $flights->appends(Input::all())->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection