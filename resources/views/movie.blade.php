@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
    <h1>Search movie </h1>
        <form action="/movies" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Search movie</label>
            <input type="text" class="form-control" name="movie">
        </div>
        
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@isset ($movies)
 <div class="row">
     <div class="col-md-12">
     <h3>Results</h3>
        @foreach ($movies->Search as $row)
                <div class="card" style="width: 16rem;">
                    <img src="{{$row->Poster}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$row->Title}} ({{$row->Year}})</h5>
                        <a href="#" class="btn btn-primary">Details</a>
                        @auth
                        <a href="/store/{{$row->imdbID}}" class="btn btn-primary">Add to favies</a>
                        @endauth
                    </div>
                </div>
        @endforeach
     </div>
    </div>
@endisset
@endsection