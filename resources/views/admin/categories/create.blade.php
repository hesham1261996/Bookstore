@extends('theme.default')

@section('heading')
    {{__('اضافة تصنيف جديد')}}
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                {{__('اضف تصنيف جديدا')}}
            </div>
            <div class="card-body">
                <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                        <label id="name" class="lable col-md-4 col-form text-md-right">{{__('اسم التصنيف')}}</label>
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
                        <label  id="description" class="lable col-md-4 col-form text-md-right">{{__('التفاصيل')}}</label>
                        <div class="col-md-6">
                            <textarea type="text"id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" autocomplete="description">
                            </textarea>
                            @error('description')
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
