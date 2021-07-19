@extends('layouts.layouts')
@section('content')
    <form action="{{ route('productUpdate',$product->id) }}" method="post">
        @csrf
    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">

                        <input type="text" class="form-control" value="{{ $product->title }}" name="productName">

                    </div>
                    <div class="col-md-3">

                        <input type="text" class="form-control" value="{{ $product->gramm }}" name="gramm">

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
                                <th scope="col">Сумма</th>
                                <th scope="col">Процент</th>
                                <th scope="col">Итого</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($product->details()->count())
                                @foreach($product->details as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->title }}

                                        </th>

                                        <td>
                                            {{ $item->brutto }}
                                        </td>
                                        <td>
                                            {{ $item->netto }}
                                        </td>
                                        <td>
                                            {{ $item->output }}
                                        </td>
                                        <td>
                                            {{ $item->comment }}
                                        </td>
                                        <td>
                                            {{ $item->price }}
                                        </td>
                                        <td>
                                            {{ $item->sum }}
                                        </td>
                                        <td>
                                           <span style="font-weight: bold;">30% =  <i style="color:red;">({{ $item->total - $item->sum }})</i></span>
                                        </td>

                                        <td>
                                            {{ $item->total }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <th scope="row">
                                    <input type="text" name="title" placeholder="Введите..." style="padding-left:10px;border:1px solid #000">
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
                               <td></td>
                                <td>
                                    <input type="text" style="width: 100px;border:1px solid #000" value="30 %" disabled>
                                </td>
                                <td>

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
