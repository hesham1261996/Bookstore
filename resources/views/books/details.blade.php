@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card-header">
                {{__('تفاصيل الكتاب')}}
            </div>
            <div class="card-body ">
                <table class="table table-stribed">
                    <tr>
                        <th>{{__('العنوان')}}</th>
                        <td class="lead">{{$book->title}}</td>
                    </tr>
                    <tr>
                        <th>{{__('تقييم الكتاب')}}</th>
                        <td>
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
                            <span>{{__('عدد المقيمين ') .$book->ratings()->count() . __(' مستخدم')}}</span>
                        </td>
                    </tr>
                    @if ($book->isbn)
                        <tr>
                            <th>{{__('الرقم التسلسلي')}}</th>
                            <td>{{$book->isbn}}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>{{__('الغلاف')}}</th>
                        <td>
                            <img src="{{asset($book->cover_image)}}" alt="">
                        </td>
                    </tr>
                    @if ($book->category)
                        <th>{{__('التصنيف')}}</th>
                        <td>{{$book->category->name}}</td>
                    @endif
                    @if ($book->authors->count() > 0)
                        <tr>
                            <th>{{$book->authors->count() < 0 ? __('المؤلفون') : __('المؤلف')}}</th>
                            <td>
                                @foreach ($book->authors as $author)
                                    {{$loop->first ? '' : 'و'}}
                                    {{$author->name}}
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    @if ($book->publisher)
                        <th>{{__('الناشر')}}</th>
                        <td>{{$book->publisher->name}}</td>
                    @endif
                    @if ($book->description)
                        <tr>
                            <th>{{__('الوصف')}}</th>
                            <td>{{$book->description}}</td>
                        </tr>
                    @endif
                    @if ($book->publish_year)
                        <tr>
                            <th>{{__('سنه النشر')}}</th>
                            <td>{{$book->publish_year}}</td>
                        </tr>
                    @endif
                        <tr>
                            <th>{{__('عدد الصفحات')}}</th>
                            <td>{{$book->number_of_pages}}</td>
                        </tr>
                        <tr>
                            <th>{{__('السعر')}}</th>
                            <td>{{$book->price}} $</td>
                        </tr>
                </table>
                @auth
                    <h4>{{__('قيم هذا الكتاب')}}</h4>
                    @if(auth()->user()->rated($book))
                        <div class="rating">
                            <span class="rating-star" {{auth()->user()->bookRating($book)->value == 5 ? 'checked' : ''}} data-value="5"></span>
                            <span class="rating-star" {{auth()->user()->bookRating($book)->value == 4 ? 'checked' : ''}} data-value="4"></span>
                            <span class="rating-star" {{auth()->user()->bookRating($book)->value == 3 ? 'checked' : ''}} data-value="3"></span>
                            <span class="rating-star" {{auth()->user()->bookRating($book)->value == 2 ? 'checked' : ''}} data-value="2"></span>
                            <span class="rating-star" {{auth()->user()->bookRating($book)->value == 1 ? 'checked' : ''}} data-value="1"></span>
                        </div>
                    @else
                        <div class="rating">
                            <span class="rating-star" data-value="5"></span>
                            <span class="rating-star" data-value="4"></span>
                            <span class="rating-star" data-value="3"></span>
                            <span class="rating-star" data-value="2"></span>
                            <span class="rating-star" data-value="1"></span>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.rating-star').click(function() {
            
            var submitStars = $(this).attr('data-value');

            $.ajax({
                type: 'post',
                url: {{ $book->id }} + '/rate',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'value' : submitStars
                },
                success: function() {
                    alert('تمت عملية التقييم بنجاح');
                    location.reload();
                },
                error: function() {
                    alert('حدث خطأ ما');
                },
            });
        });
    </script>
@endsection