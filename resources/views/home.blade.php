@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Add Libraries
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBook">
        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Add Book
    </button>
    <div class="row">
        @foreach($libraries as $librarie)
            <div class="col-md-4">
                <div class="card mb-4 shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-center font-weight-bold">{{$librarie->title}}</h4>
                        <div class="row">
                            @foreach($books as $book)
                            @if($book->libraries_id == $librarie->id)
                            <div class="col-xs-4 col-4">
                                {{$book->title}}
                            </div>
                            @endif
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        
        @endforeach
    </div>

    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Libraries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route ('create.libraries') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="desc" name="desc"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Add Libraries</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="createBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route ('create.book') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <select id="libraries_id" name="libraries_id" class="form-control @error('libraries_id') is-invalid @enderror">
                            <option value="">-- Choose Libraries --</option>
                            @foreach ($libraries as $data)
                                <option value="{{ $data->id }}">{{ $data->title }}</option>
                            @endforeach
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Add Libraries</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection