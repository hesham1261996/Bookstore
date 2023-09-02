@extends('theme.default')


@section('heading')
{{__('عرض تفاصيل الكتاب')}}
@endsection

@section('head')
    <style>
        table{
            table-layout: fixed ; 
        }
        table tr th {
            width: 30% ;
        }
    </style>
@endsection
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
                            <img src="{{asset("storage/$book->cover_image")}}" alt="">
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
                                @foreach ($book->authors as $auther)
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
                <a href="{{route('book.edit' , $book)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection