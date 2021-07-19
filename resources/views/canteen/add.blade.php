@extends('layouts.layouts')
@section('content')
    <form action="{{ route('productAdd') }}" method="post">
        @csrf
    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <input type="text" class="form-control" placeholder="Название" name="productName">

                    </div>
                    <div class="col-md-3">

                        <input type="text" class="form-control" placeholder="Укажите грамм" name="gramm">

                    </div>
                    <div class="col-md-3">

                        <input type="submit" class="btn btn-success" value="Создать">

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

                        <table class="table">
                            <thead>
                            <tr>

                                <th scope="col">Наименование продукта </th>

                                <th scope="col">Брутто</th>
                                <th scope="col">Нетто</th>
                                <th scope="col">Выход</th>
                                <th scope="col">Примечение</th>
                                <th scope="col">Цена</th>

                                <th scope="col">Процент</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    <input type="text" name="title" placeholder="Введите..." style="padding-left:10px;border:1px solid #000" required>
                                    <span style="cursor: pointer;"> <i class="zmdi zmdi-folder" style="width: 25px;"></i>Выбрать</span>
                                </th>

                                <td>
                                    <input type="text"  style="width: 100px;border:1px solid #000" name="brutto">
                                </td>
                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" name="netto">
                                </td>
                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" name="output">
                                </td>
                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" name="comment">
                                </td>
                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" name="price">
                                </td>

                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" value="30 %" disabled>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        </div>

    </section>



    <!-- END PAGE CONTAINER-->
    </div>

    </div>
    </form>
@endsection
@push('js')

@endpush
