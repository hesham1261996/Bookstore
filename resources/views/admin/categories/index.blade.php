@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">
@endsection

@section('heading')
{{__('عرض التصنيفات')}}
@endsection

@section('content')
    <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>{{__('اضافه تصنيف جديد')}}</a>
    <div class="rew">
        <div class="col-md-12">
            <table id="categories-table" class="table table-striped table-bordered text-right" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th>{{__('اسم التصنيف')}}</th>
                        <th>{{__('الوصف')}}</th>
                        <th class="text-center">{{__('خيارات')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><a href="{{route('categories.show' , $category)}}">{{\Str::limit($category->name, 20)}}</a></td>
                            <td>{{\Str::limit($category->description, 30)}}</td>
                            <td class="text-center">
                                <a href="{{route('categories.edit' , $category)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</a>
                                <form action="{{route('categories.destroy' , $category)}}" method="post" class="d-inline-block">
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
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#categories-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection