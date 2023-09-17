@extends('theme.default')
@section('head')
    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet')}}">
@endsection

@section('heading')
{{__('عرض المستخدمين')}}
@endsection

@section('content')
    <div class="rew">
        <div class="col-md-12">
            <table id="categories-table" class="table table-striped table-bordered text-right" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th>{{__('اسم المستخدم')}}</th>
                        <th>{{__('البريد الالكتروني')}}</th>
                        <th>{{__('نوع المستخدم')}}</th>
                        <th class="text-center">{{__('خيارات')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->isSuperAdmin() ?__('مدير') : ($user->isAdmin() ? __('مشرف'):__('مستخدم') )}}</td>
                        <td>
                            <form class="ml-4 form-inline" action="{{route('users.update' , $user)}}" method="POST" style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <select class="form-control form-control-sm" name="administration_level" id="">
                                    <option selected disabled >{{__('اختر')}}</option>
                                    <option value="0">{{__('مستخدم')}}</option>
                                    <option value="1">{{__('مشرف')}}</option>
                                    <option value="2">{{__('مدير')}}</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('تعديل')}}</button>
                            </form>
                            <form class="" action="{{route('users.destroy' , $user)}}" method="POST" style="display:inline-block">
                                @if (auth()->user() != $user)
                                    <button type="submit" class="btn btn-danger btm-sm" onclick="return confirm('هل انت متاكد')"><i class="fa fa-trash"></i>{{__('حذف')}}</button>
                                @else
                                    <div class="btn btn-danger disabled"><i class="fa fa-trash"></i>{{__('حذف')}}</div>
                                @endif
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