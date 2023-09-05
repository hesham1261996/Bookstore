@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">
@endsection

@section('heading')
{{__('عرض المؤلفون')}}
@endsection

@section('content')
    <a href="{{route('authors.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>{{__('اضافه مؤلف جديد')}}</a>
    <div class="rew">
        <div class="col-md-12">
            <table id="authors-table" class="table table-striped table-bordered text-right" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th>{{__('اسم المؤلف')}}</th>
                        <th>{{__('الوصف')}}</th>
                        <th class="text-center">{{__('خيارات')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td><a href="{{route('authors.show' , $author)}}">{{\Str::limit($author->name, 20)}}</a></td>
                            <td>{{\Str::limit($author->description, 30)}}</td>
                            <td class="text-center">
                                <a href="{{route('authors.edit' , $author)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</a>
                                <form action="{{route('authors.destroy' , $author)}}" method="post" class="d-inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متاكد؟')"><i class="fa fa-trash"></i>{{__('حذف')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{$authors->links()}}
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#authors-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection
