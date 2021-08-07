<div class="modal fade" id="edit_list_{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_list_{{$list->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- form -->
                <form action="/edit_list/{{$list->id}}" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label>List Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $list->title }}" required>
                    </div>

                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="text-danger">
                        {{$error}}
                    </div>
                    @endforeach
                    @endif

                    <button type="submit" class="btn btn-primary ms-auto mt-3">Change</button>

                </form>

            </div>

        </div>

    </div>
</div>