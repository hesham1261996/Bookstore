@extends('theme.default')

@section('heading')
    {{__('اضافة ناشر جديد')}}
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                {{__('اضف مؤلف جديدا')}}
            </div>
            <div class="card-body">
                <form action="{{route('publishers.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                        <label id="name" class="lable col-md-4 col-form text-md-right">{{__('اسم الناشر')}}</label>
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  id="address" class="lable col-md-4 col-form text-md-right">{{__('العنوان')}}</label>
                        <div class="col-md-6">
                            <textarea type="text"id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" autocomplete="address">
                            </textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-1">
                            <button class="btn btn-primary" type="submit">{{__('اضافه')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
