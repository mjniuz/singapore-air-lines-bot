@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div id="style">
            <div class="col-md-3"></div>
            <div class="col-md-6">
          {{-- <div class="col-md-8 col-md-offset-3"> --}}
              <div id="title">
                <p>
                  {{ $promotion->title }}
                </p>
              </div>
              <div id="content">
                  @if (!empty($promotion->image))
                    <img src="{{ $promotion->image_file }}" class="image">
                  @endif
                  <p>
                    {{ $promotion->description }}
                  </p>
              </div>
          </div>
          <div class="col-md-6"></div>
        </div>
    </div>
</div>
@endsection