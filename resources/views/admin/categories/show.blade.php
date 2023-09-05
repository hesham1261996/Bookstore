@extends('theme.default')


@section('heading')
{{__('عرض تفاصيل التصنيف')}}
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
                {{__('تفاصيل التصنيف: ') . $category->name}}
            </div>
            <div class="card-body ">
                <table class="table table-stribed">
                    <tr>
                        <th>{{__('الاسم')}}</th>
                        <td class="lead">{{$category->name}}</td>
                    @if ($category->description)
                        <tr>
                            <th>{{__('الوصف')}}</th>
                            <td>{{$category->description}}</td>
                        </tr>
                    @endif
                </table>
                <a href="{{route('categories.edit' , $category)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</a>
                <form action="{{route('categories.destroy' , $category)}}" method="post" class="d-inline-block">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متاكد؟')"><i class="fa fa-trash"></i>{{__('حذف')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection