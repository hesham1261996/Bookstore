@extends('theme.default')

@section('heading')
    {{__('تعديل بيانات الكتاب')}}
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="card mb-4 col-md-8">
            <div class="card-header text">
                {{__('تعديل الكتاب:') . $book->title}}
            </div>
            <div class="card-body">
                <form action="{{route('book.update' , $book)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label id="title" class="lable col-md-4 col-form text-md-right">{{__('عنوان الكتاب')}}</label>
                        <div class="col-md-6">
                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{$book->title}}" autocomplete="title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="isbn" class="lable col-md-4 col-form text-md-right">{{__('الرقم التسلسلي')}}</label>
                        <div class="col-md-6">
                            <input type="text" id="isbn" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{$book->isbn}}" autocomplete="isbn">
                            @error('isbn')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="cover_image" class="lable col-md-4 col-form text-md-right">{{__('اختر صوره')}}</label>
                        <div class="col-md-6">
                            <input type="file" onchange="readCoverImage(this)" accept="image/*" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image')}}" autocomplete="cover_image">
                            @error('cover_image')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <img src="{{asset('storage/'. $book->cover_image)}}" alt="" id="cover-image-thumb" class="img-fluid img-thumbnail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="category" class="lable col-md-4 col-form text-md-right">{{__('التصنيف')}}</label>
                        <div class="col-md-6">
                            <select name="categories" id="category" class="form-control">
                                <option disabled {{$book->category== null ? 'selected' : ''}}>{{__('اختر تصنيف')}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}} "{{$book->category == $category ? 'selected': '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="authors" class="lable col-md-4 col-form text-md-right">{{__('المؤلفون')}}</label>
                        <div class="col-md-6">
                            <select name="authors[]" multiple id="authors" class="form-control">
                                <option disabled {{$book->authors->count() == 0 ?'selected' : ''}}>{{__('اختر مؤلف')}}</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author->id}}" {{$book->authors->contains($author) ? 'selected' : ''}}>{{$author->name}}</option>
                                @endforeach
                            </select>
                            @error('authors')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="publisher" class="lable col-md-4 col-form text-md-right">{{__('الناشر')}}</label>
                        <div class="col-md-6">
                            <select name="publisher" id="publisher" class="form-control">
                                <option disabled {{ $book->publisher ==null ?'selected' : ''}}>{{__('اختر ناشر')}}</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{$publisher->id}}" {{$book->publisher == $publisher? 'selected':''}}>{{$publisher->name}}</option>
                                @endforeach
                            </select>
                            @error('publisher')
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
                                {{$book->description}}
                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="publish_year" class="lable col-md-4 col-form text-md-right">{{__('سنه النشر')}}</label>
                        <div class="col-md-6">
                            <input id="publish_year" name="publish_year" type="number" class="form-control @error('publish_year') is-invalid @enderror" value="{{$book->publish_year}}" autocomplete="publish_year">
                            @error('publish_year')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="number_of_copies" class="lable col-md-4 col-form text-md-right">{{__('عدد الصفحات')}}</label>
                        <div class="col-md-6">
                            <input id="number_of_pages" name="number_of_pages" type="number" class="form-control @error('number_of_pages') is-invalid @enderror" value="{{$book->number_of_pages}}" autocomplete="number_of_pages">
                            @error('number_of_pages')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="number_of_capies" class="lable col-md-4 col-form text-md-right">{{__('عدد النسخ')}}</label>
                        <div class="col-md-6">
                            <input type="number"id="number_of_capies" name="number_of_capies" class="form-control @error('number_of_capies') is-invalid @enderror" value="{{$book->number_of_copies}}" autocomplete="number_of_capies">
                            @error('number_of_capies')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label id="price" class="lable col-md-4 col-form text-md-right">{{__('السعر')}}</label>
                        <div class="col-md-6">
                            <input id="price" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{$book->price}}" autocomplete="price">
                            @error('price')
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

@section('script')
<script>
    function readCoverImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#cover-image-thumb')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection