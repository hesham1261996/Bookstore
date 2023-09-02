@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">
@endsection

@section('heading')
{{__('عرض الكتب')}}
@endsection

@section('content')
    <a href="{{route('book.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>{{__('اضافه كتاب جديد')}}</a>
    <div class="rew">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th>{{__('العنوان')}}</th>
                        <th>{{__('الرقم التسلسلي')}}</th>
                        <th>{{__('التصنيف')}}</th>
                        <th>{{__('المؤلفون')}}</th>
                        <th>{{__('الناشر')}}</th>
                        <th>{{__('السعر')}}</th>
                        <th>{{__('خيارات')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td><a href="{{route('book.show' , $book)}}">{{$book->title}}</a></td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->category != null ? $book->category->name : ''}}</td>
                            <td>
                                @if ($book->authors->count() > 0)
                                    @foreach ($book->authors as $author )
                                        {{$loop->first ? '' :","}}
                                        {{$author->name}}
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$book->publisher != null ? $book->publisher->name : ''}}</td>
                            <td>{{$book->price}}$</td>
                            <td>
                                <a href="{{route('book.edit' , $book)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#books-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection