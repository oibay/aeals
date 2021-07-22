@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Заявки
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

                                <th>Дата</th>
                                <th>Отдел</th>


                                <th>Локация</th>
                                <th>Фотография</th>
                                <th>Описание</th>
                                <th>Статус</th>

                                <th>Время</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($ticket->count() > 0)
                                @foreach($ticket as $item)
                            <tr>

                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <h3><span class="badge bg-dark" style="color:White;border-radius: 100px;">{{ $item->dep['title'] }}</span></h3>
                                        </td>

                                        <td>
                                            <h3><span class="badge bg-info" style="color:White;border-radius: 100px;">{{ $item->location }}</span></h3>
                                        </td>
                                        <td>
                                            @if($item->photo != '0')
                                                <a data-fancybox="gallery" href="{{ asset('images/'.$item->photo) }}">
                                                    <img src="{{ asset('images/'.$item->photo) }}" style='width:100px;' alt="1"></a>

                                            @endif
                                        </td>
                                        <td>{{ $item->description ?? '' }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <h3><span class="badge bg-danger" style="color:White;border-radius: 100px;">Ожидает</span></h3>
                                            @elseif($item->status == 1)
                                                <h3><span class="badge bg-success" style="color:White;border-radius: 100px;">Закрыт</span></h3>
                                            @endif
                                        </td>

                                        <td>
                                            Прошло: <h4><span class="badge bg-warning" style="color:White;border-radius: 100px;">
                                                            {{ round(abs(time() - strtotime($item->created_at)) / 60). " минут" }}
                                                        </span></h4>
                                        </td>

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
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.0/jquery.fancybox.min.css" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.0/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
