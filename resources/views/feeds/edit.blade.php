@extends('main')

@section('content')
    <div class="row">
        <div class=" col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Feed</h3>
                </div>
                <div class="panel-body">
                    <form class="" action="{{url('feeds',$feed->id)}}" method="post">
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            @foreach ($errors->get('name') as $err)
                                <div class="alert alert-danger">
                                    {{$err}}
                                </div>
                            @endforeach
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                   value="{{$feed->name}}">
                        </div>
                        <div class="form-group">
                            <label for="xmlUrl">Xml url</label>
                            @foreach ($errors->get('xmlUrl') as $err)
                                <div class="alert alert-danger">
                                    {{$err}}
                                </div>
                            @endforeach
                            <input type="text" class="form-control" id="xmlUrl" name="xmlUrl" placeholder="Xml url"
                                   value="{{$feed->xmlUrl}}">
                        </div>
                        <div class="form-group">
                            <label for="htmlUrl">Html url</label>
                            <input type="text" class="form-control" id="htmlUrl" name="htmlUrl" placeholder="Html url"
                                   value="{{$feed->htmlUrl}}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category_id">
                                @foreach ($categories as $cat)
                                    <option name="category_id" value="{{$cat->id}}"
                                            @if ($feed->category_id == $cat->id)
                                            selected="selected"
                                            @endif>
                                        {{$cat->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
