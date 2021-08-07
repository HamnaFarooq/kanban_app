<div class="modal fade" id="edit_card_{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="add_card_{{$card->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Edit Card</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- form -->
                <form action="/edit_card/{{$card->id}}" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <label>Card Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{$card->title}}" required>
                    </div>

                    <div class="form-group">
                        <label>Card Description:</label>
                        <textarea class="form-control" name="description" required> {{$card->description}} </textarea>
                    </div>

                    <div class="form-group">
                        <label for="formFile" class="form-label mt-4">Add File</label>
                        <input class="form-control" type="file" id="formFile" name="attachment" accept="image/*">
                    </div>

                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="text-danger">
                        {{$error}}
                    </div>
                    @endforeach
                    @endif

                    <button type="submit" class="btn btn-primary ms-auto mt-3">Submit</button>

                </form>

            </div>

        </div>

    </div>
</div>