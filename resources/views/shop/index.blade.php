@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Меню</h3>

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
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Кол-во</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <form action="{{ route('send_to_pay') }}" method="post">
                                @csrf

                            @foreach($shop as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }} тг</td>
                                    <td>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input type="text" value="1" name="total[{{ $item->id }}]"/>
                                            <span class="plus">+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="checked[{{ $item->id }}]"/>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <br />
                        <div class="col-xl-3 float-right" >
                            <button class="btn btn-success" type="submit">Отправить на оплату</button>
                        </div>
                        <br />
                        <br />
                        </form>
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
        input {
            height: 34px;
            width: 40px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
        }
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
