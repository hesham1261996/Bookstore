@extends('layouts.main')

@section('content')
    <div class="container">
        <a href="{{route('gallery.index')}}" class="btn btn-primary mb-5"><i class="fas fa-plus"></i>{{__('شراء كتاب جديد')}}</a>
        <div class="d-flex justify-content-center row">
            @if($mybooks->count())
                @foreach ($mybooks as $book)                    
                    <div class="col-md-10">
                        <div class="row p-2 bg-white border rounded">
                            <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{asset($book->cover_image)}}"></div>
                            <div class="col-md-6 my-auto">
                                <h5><a href="{{route('book.details' , $book)}}">{{$book->title}}</a></h5>
                                <div class="d-flex flex-row">
                                    <div class="ratings mr-2">
                                        <span class="score">
                                            <div class="score-wrap">
                                                <span class="stars-active" style="width: {{ $book->rate()*20 }}%">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                                
                                                <span class="stars-inactive">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-1 mb-1 spec-1"><span>{{$book->category != null ? $book->category->name : '' }}</span></div>
                                <div class="mt-1 mb-1 spec-1"><span>{{__('تاريخ الشراء :').$book->pivot->created_at->diffForHumans()}}</span></div>
                                <p class="text-justify text-truncate para mb-0">{{__('عدد النسخ : ') . $book->pivot->number_of_copies}}</p>
                            </div>
                            <div class="align-items-center align-content-center col-md-3 border-left my-auto">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">${{$book->price}}</h4>
                                </div>
                                <h6 class="text-success">{{__('المجموع الكلي: ').$book->pivot->number_of_copies * $book->price}} $</h6>
                                <div class="d-flex flex-column mt-4"><a href="{{route('book.details' , $book)}}" class="btn btn-outline-primary btm-sm">{{__('تفاصيل الكتاب')}}</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                    <div class="alert alert-danger mx-auto">
                        {{__('لا يوجد مشتريات ')}}
                    </div>
            @endif
        </div>
    </div>
@endsection