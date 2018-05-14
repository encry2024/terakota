@extends('frontend.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="ml-1">
            <div class="dining_pad">
                @foreach ($dinings as $dining)
                <a class="btn btn-light table-key" href="{{ route('frontend.cashier.order.create', $dining->id) }}">{{ $dining->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div><!-- row -->
@endsection