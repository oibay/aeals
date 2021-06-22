@extends('layouts.layouts')
@section('content')

    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        Редактировать : <strong>{{ $room->title }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="m-t-10">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        @include('message')
                        <form action="{{ route('postEditNumber',$room->id) }}" method="post">
                            <div class="modal-body">

                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="number" class="form-control-label">Название </label>

                                            <input id="number" type="text" class="form-control" name="number" value="{{ $room->number }}"  >

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label >Локация</label>
                                            <select class="form-control" name="location" required>
                                                <option value="">Не выбрано</option>

                                                <option value="bpark" @if($room->location == 'bpark') selected @endif>Жангырхан 72Б 1-БЛОК</option>
                                                <option value="bpark-2" @if($room->location == 'bpark-2') selected @endif>Жангырхан 72Б 2-БЛОК</option>
                                                <option value="apec" @if($room->location == 'apec') selected @endif>Apec Petrotechnic</option>

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

                                <button type="submit" class="btn btn-primary">Редактировать</button>
                            </div>
                        </form>
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
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
