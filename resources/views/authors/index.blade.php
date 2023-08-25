@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card header mb-20">{{__('المؤلفون')}}</div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <form action="{{route('gallery.author.search')}}" method="GET">
                                <div class="row d-flex justify-content-center">
                                    <input type="text" class="mx-sm-3 mb-2" name="term" placeholder="ابحث عن تصنيف...">
                                    <button type="submit" class="btn btn-secondary bg-secondary mb-2">ابحث</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <br>
                        <h3 class="mb-4">{{$title}}</h3>
                        @if ($authors->count())
                            <ul class="list-group">
                                @foreach ($authors as $author)
                                    <a style="color:gray" href="{{route('gallery.author.show' , $author)}}">
                                        <li class="list-group-item">
                                            {{$author->name}} ({{$author->books->count()}})
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-primary text-center" role="alert">
                                لا نتائج
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection