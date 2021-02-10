@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Add Libraries
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBook">
        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Add Book
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteLibraries">
        <i class="nav-icon fas fa-trash"></i> Delete Libraries
    </button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBook">
        <i class="nav-icon fas fa-trash"></i> Delete Book
    </button>
    <br><br><br>
    <div class="row">
        @foreach($libraries as $librarie)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body shadow-lg">
                        <h4 class="card-title text-left font-weight-bold">{{$librarie->title}} </h4>
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
                            <option >-- Choose Libraries --</option>
                            @foreach ($libraries as $data)
                                <option value="{{ $data->id }}">{{ $data->title }}</option>
                            @endforeach
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Add Book</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteLibraries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Libraries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($libraries as $data)
                    <form method="post" action="{{route ('delete.libraries', $data->id) }}">
                        @csrf
                        @method('delete')
                                <button class="button btn btn-primary text-light font-weight-bold " value="{{$data->id}}" type="submit">{{$data->title}}</button>
                                <br><br>
                    </form>
                    @endforeach
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($books as $data)
                    <form method="post" action="{{route ('delete.book', $data->id) }}">
                        @csrf
                        @method('delete')
                                <button class="button btn btn-primary text-light font-weight-bold " value="{{$data->id}}" 
                                    type="button" onclick="deleteConfirmation({{$data->id}})">{{$data->title}}
                                </button>
                                <br><br>
                    </form>
                    @endforeach
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    function deleteConfirmation(id) {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
    }
</script>


@endsection