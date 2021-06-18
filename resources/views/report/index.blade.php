@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Отчеты

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-4">
                        @include('message')
                        <div class="card">
                            <h5 class="card-header">За месяц</h5>
                            <form action="{{ route('reportMonth') }}" method="post">
                            <div class="card-body">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Месяц</label>
                                        <input type="month" class="form-control" name="month">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <input type="submit" class="btn btn-primary" value="Скачать " >
                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4">

                        <div class="card">
                            <h5 class="card-header">За неделю</h5>
                            <div class="card-body">

                                <a href="{{ url('admin/report/weekly') }}" class="btn btn-primary">Скачать</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">

                        <div class="card">
                            <h5 class="card-header">За день</h5>
                            <div class="card-body">
                                <a href="{{ url('admin/report/dailyReport') }}" class="btn btn-primary">Скачать</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>



    <!-- END PAGE CONTAINER-->
    </div>

    </div>
@endsection
@push('js')

@endpush
