@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#mediumModal">
                            <i class="zmdi zmdi-plus"></i> Добавить
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
                                <th>Номер комнаты</th>
                                <th>Локация</th>
                                <th>Дата создана</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($room->count() > 0)
                                @foreach($room as $item)
                                    <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><a href="{{ url('admin/room-number/edit',$item->id) }}">
                                                {{ $item->number }}
                                            </a></td>
                                        <td>
                                            @if($item->location == 'apec')
                                                Apec Petrotechnic
                                            @elseif($item->location == 'bpark')
                                                Жангырхан 72Б 1 БЛОК
                                            @elseif($item->location == 'bpark-2')
                                                Жангырхан 72Б 2 БЛОК
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/room-number/edit',$item->id) }}">

                                                <i class="zmdi zmdi-edit" style="color:red;width: 20px;"></i>
                                            </a>

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
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('postAddNumber') }}" method="post">
                    <div class="modal-body">

                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Номер комнаты </label>

                                    <input id="name" type="text" class="form-control" name="number" value="" placeholder="Введите номер комнаты" >

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Локация</label>
                                    <select class="form-control" name="location" required>
                                        <option value="">Не выбрано</option>
                                        <option value="bpark" >Жангырхан 72Б 1-БЛОК</option>
                                        <option value="bpark-2" >Жангырхан 72Б 2-БЛОК</option>
                                        <option value="apec">Apec Petrotechnic</option>

                                    </select>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- END PAGE CONTAINER-->
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
