@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('عربه التسوق')}}</div>
                    <div class="card-body">
                        @if ($items->count() > 0 )
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{__('اسم الكتاب')}}</th>
                                        <th>{{__('السعر')}}</th>
                                        <th>{{__('الكميه')}}</th>
                                        <th>{{__('السعر الكلي')}}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @php($totalPrice = 0)
                                @foreach ($items as $item )
                                    @php($totalPrice += $item->price * $item->pivot->number_of_copies)
                                    <tbody>
                                        <tr>
                                            <td scope='row'>{{$item->title}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->pivot->number_of_copies}}</td>
                                            <td>{{$item->price * $item->pivot->number_of_copies}} $</td>
                                            <td>
                                                <form action="{{route('cart.remaveAll' , $item->id)}}" method="POST" style="float:left; margin: auto 5px">
                                                    @csrf
                                                    <button class="btn btn-outline-danger btn-sm" type="submit">{{__('ازاله الكل')}}</button>
                                                </form>
                                                <form action="{{route('cart.removeOne' , $item->id)}}" method="POST" style="float:left; margin: auto 5px">
                                                    @csrf
                                                    <button class="btn btn-outline-warning btn-sm" type="submit">{{__('ازاله نسخه')}}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <hr>
                            <h4 class="md-5">{{__('المجموع الكلي : ')}}{{$totalPrice}} $</h4>
                            <a href="{{route('credit.checkout')}}" class="d-inline-block md-4 float-start btn bg-cart" style="text-decoration: none">
                                <span>{{__('بطاقه ائتمانيه')}}</span>
                                <i class="fas fa-credit-card"></i>
                            </a>
                        @else
                            <div class="alert alert-info text-center">{{__('لا يوجد كتب في العربه')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
