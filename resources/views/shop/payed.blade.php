@extends('layouts.layouts')
@section('content')

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">


                </div>
            </div>
        </div>
    </div>
</section>
    <section class="m-t-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-12">
                        @include('message')
                        <table id="table_id" class="display">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Тотал</th>
                                <th>Продукт</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data->count() > 0)
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>
                                            <script>
                                                console.log(JSON.parse('{"product":[{"id":1,"title":"Кока Кола 0,5 ","price":200,"created_at":"2021-08-17T06:50:08.000000Z","updated_at":"2021-08-17T06:50:08.000000Z"},{"id":2,"title":"Кока кола 1 ","price":320,"created_at":"2021-08-17T06:50:08.000000Z","updated_at":"2021-08-17T06:50:08.000000Z"}],"total":["1","1"]}'))
                                            </script>
                                        </td>
                                        <td>
                                            <h4><span class="badge badge-success">Оплачено</span></h4>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
@push('js')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
