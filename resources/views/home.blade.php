@extends('layouts.app')

@section('script')

<div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Books</h2>
                    
                </div>
                <div class="card shadow-lg border-0">
                    <form action="" method="get">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-md-10">
                                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Search by title">

                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <button class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>           
                                    <a href="{{ route('home') }}" class="btn btn-secondary  ms-2">Clear</a>                                                         
                                </div>                                                                                 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mt-4">
                    @if($books->isNotEmpty())
                        @foreach($books as $book)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card border-0 shadow-lg">

                                    <a href="{{ route('book.detail', $book->id) }}">
                                    @if($book->image != '')
                                        <img src="{{ asset('uploads/books/thumb/'.$book->image) }}" alt="" class="card-img-top">
                                    @else
                                        <img src="https://placehold.co/990x1400?text = No Image" alt="" class="card-img-top">
                                    @endif
                                    </a>
                                    <div class="card-body">
                                        <h3 class="h4 heading"><a href="#">{{ $book->title }}</a></h3>
                                        <p>By: {{ $book->author }}</p>
                                        @php
                                        if($book->reviews_count > 0){
                                            $avgRating = $book->reviews_sum_rating/$book->reviews_count;
                                        }else{
                                            $avgRating = 0;
                                        }
                                        $avgRatingPer = ($avgRating*100)/5;
                                        @endphp
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">{{ number_format($avgRating, 1) }}</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                
                                                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted">({{ ($book->reviews_count > 1) ? $book->reviews_count.'Reviews' : 'Review' }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{$books->links();}}
                    
                </div>
            </div>
        </div>
    </div>   
@endsection