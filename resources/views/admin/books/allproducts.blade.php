@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">
@endsection

@section('heading')
{{__('المشتريات')}}
@endsection

@section('content')
    <a href="{{route('book.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i>{{__('اضافه كتاب جديد')}}</a>
    <div class="rew">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th>{{__('المشتري')}}</th>
                        <th>{{__('الكتاب')}}</th>
                        <th>{{__('السعر')}}</th>
                        <th>{{__('عدد النسخ')}}</th>
                        <th>{{__('السعر الاجمالي')}}</th>
                        <th>{{__('تاريخ الشراء')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allpurches as $purches)
                        <tr>
                            <td>{{\App\Models\User::find($purches->user_id)->name}}</td>
                            <td><a href="{{route('book.details' , $purches->book_id)}}">{{\App\Models\Book::find($purches->book_id)->title}}</a></td>
                            <td>{{$purches->price}} $</td>
                            <td>{{$purches->number_of_copies}}</td>
                            <td>{{$purches->price * $purches->number_of_copies}} $</td>
                            <td>{{$purches->created_at->diffForHumans()}}</td>
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