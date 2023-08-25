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
                    @if ($book->authers->count() > 0)
                        <tr>
                            <th>{{$book->authers->count() < 0 ? __('المؤلفون') : __('المؤلف')}}</th>
                            <td>
                                @foreach ($book->authers as $auther)
                                    {{$loop->first ? '' : 'و'}}
                                    {{$auther->name}}
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
                </table>
            </div>
        </div>
    </div>
</div>
@endsection