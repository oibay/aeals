@extends('layouts.layouts')
@section('content')

<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#reportModal">
                        <i class="zmdi zmdi-download"></i> Скачать репорт
                    </button>

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
                                            @foreach($item->log as $log)
                                                <ul>
                                                    <li> {{ $log->menu['title'] }} ( <strong>{{ $log->total }}</strong>) шт.Цена {{ $log->menu['price'] }} тг</li>
                                                </ul>
                                            @endforeach
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
<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Скачать репорт</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('report_payment') }}" method="POST">
                <div class="modal-body">

                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="entry" class="form-control-label">От </label>

                            <input id="entry" type="date" class="form-control{{ $errors->has('entry_to') ? ' is-invalid' : '' }}" name="entry_to" >

                            @if ($errors->has('entry_to'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry_to') }}</strong>
                                                </span>
                            @endif


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="entry" class="form-control-label">До </label>

                            <input id="entry" type="date" class="form-control{{ $errors->has('entry_from') ? ' is-invalid' : '' }}" name="entry_from" >

                            @if ($errors->has('entry_from'))
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('entry_from') }}</strong>
                                                </span>
                            @endif


                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Скачать</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
