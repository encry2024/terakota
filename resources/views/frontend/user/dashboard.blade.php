@extends('frontend.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="ml-1">
            <div class="dining_pad">
                @foreach ($dinings as $dining)
                    <a class="btn btn-light table-key" data-id="{{ $dining->id }}">{{ $dining->name }}
                        <form action="{{ route('frontend.cashier.order.store') }}" method="POST" name="create_order">
                            {{ csrf_field() }}
                            <input type="hidden" name="dining_id" value="{{ $dining->id }}">
                        </form>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div><!-- row -->
@endsection

@push('after-scripts')
<script>
$(function () {
    $('.table-key').on('click', function () {
        let button = $(this);

        $.ajax({
            type: "POST",
            url: "{{ route('frontend.cashier.order.check_availability') }}",
            data: {
                _token: "{{ csrf_token() }}",
                dining_id: button.data('id')
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status == "false")
                    swal({
                        title: 'Create an Order?',
                        confirmButtonText: 'Create',
                        showCancelButton: true,
                        type: 'warning'
                    }).then((result) => {
                        if (result.value) {
                            button.find("form").submit();
                        }
                    });
                else
                    var url = "{{ route('frontend.cashier.order.create_order', ['order' => ':order_id', 'dining' => ':dining_id']) }}";
                        url = url.replace(':order_id', data.order.id);
                        url = url.replace(':dining_id', data.order.dining_id);

                    window.location = url;
            }
        });
    })
})
</script>
@endpush