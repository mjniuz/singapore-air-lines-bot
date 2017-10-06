@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div id="style">
            <div class="col-md-6">

                <h4>Passenger Information</h4>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>
                            Full Name
                        </td>
                        <td>
                            John {{ $checkIn->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Flight Number
                        </td>
                        <td>
                            {{ $checkIn->flight_number }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Departure Code / City
                        </td>
                        <td>
                            {{ $checkIn->departure_airport_code }} - {{ $checkIn->departure_city }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Departure Terminal / Gate
                        </td>
                        <td>
                            {{ $checkIn->departure_terminal }} / {{ $checkIn->departure_gate }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Arrival Code / City
                        </td>
                        <td>
                            {{ $checkIn->arrival_airport_code }} - {{ $checkIn->arrival_city }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Arrival Terminal / Gate
                        </td>
                        <td>
                            {{ $checkIn->arrival_terminal }} / {{ $checkIn->arrival_gate }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Boarding Time
                        </td>
                        <td>
                            {{ date("m F Y H:i", strtotime($checkIn->flight_schedule_boarding)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Departure / Arrival Time
                        </td>
                        <td>
                            {{ date("H:i", strtotime($checkIn->flight_schedule_departure)) }} / {{ date("H:i", strtotime($checkIn->flight_schedule_arrival)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Seats
                        </td>
                        <td>
                            <span class="red" id="seat-selected">
                                @if($checkIn->seats != "")
                                    {{ json_decode($checkIn->seats)[0] }}
                                @else
                                    Please select seat on the right
                                @endif
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                {!! Form::open(['url' =>  url('check-in/' . $checkIn->token ), 'id' => 'check-in-form']) !!}
                    <input type="hidden" id="seats-value" name="seats" value="{{ ($checkIn->seats != "") ? $checkIn->seats : "" }}"/>
                    <button type="submit" id="btn-submit" class="btn btn-success" {{ ($checkIn->seats != "") ? "disabled" : "" }}>
                        Save
                    </button>
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                <div id="title">
                    <p>
                        {{ $checkIn->user->pnr_number }}
                    </p>
                </div>
                <div id="content">
                    @include('frontend._partials.seat-check-in')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection