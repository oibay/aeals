@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Всего стоимость : {{ $data->total }} ТГ</h2> <br>
                        <a href="{{ url('shop/approved/'.$data->id) }}" class="btn btn-success">Подтвердить оплату</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10" >
        <div class="section__content section__content--p30" style="background: white">
            <div class="container-fluid" >
                <div class="row" >

                    <div class="col-xl-12" >
                        @include('message')

                        <div style="text-align: center"><img src="{{ asset('images/qrcode.PNG') }}"></div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
@push('css')
    <style>
        span {cursor:pointer; }

        .minus, .plus{
            width:30px;
            height:30px;
            background:#f2f2f2;
            border-radius:4px;

            border:1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
        }
        input{
            height:34px;
            width: 100px;
            text-align: center;
            font-size: 26px;
            border:1px solid #ddd;
            border-radius:4px;
            display: inline-block;
            vertical-align: middle;

    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>
@endpush
