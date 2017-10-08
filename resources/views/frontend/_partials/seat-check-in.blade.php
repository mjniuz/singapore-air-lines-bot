<div class="plane">
    <div class="cockpit">
        <h1>Please select a seat</h1>
    </div>
    <div class="exit exit--front fuselage">

    </div>
    <ol class="cabin fuselage">
        @foreach($seats as $key => $seat)
            <li class="row row--{{ ($key + 1) }}">
                <ol class="seats" type="A">
                    @foreach($seat->numbers as $number)
                        <li class="seat">
                            <input type="checkbox" {{ ($number->is_disabled) ? "disabled" : "" }} id="{{ strtoupper($number->id) }}" value="{{ strtolower($number->id) }}" name="seats"/>
                            <label for="{{ strtoupper($number->id) }}">
                                {{ ($number->is_disabled) ? "x" : strtoupper($number->id) }}
                            </label>
                        </li>
                    @endforeach
                </ol>
            </li>
        @endforeach
    </ol>
    <div class="exit exit--back fuselage">

    </div>
</div>