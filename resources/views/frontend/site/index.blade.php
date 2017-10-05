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
                          <th>No</th>
                          <th>Format</th>
                          <th>Example</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($chats as $key => $chat)
                          <tr>
                            <td align="center">
                              {{ $key+1 }}
                            </td>
                            <td>{{ $chat->format_chat }}</td>
                            <td>{{ $chat->example_chat }}</td>
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