<x-app-layout>

    <h2 class="mb-2"> Lists </h2>

    <div class="row py-3" style="display: block;">
        <form action="/add_list" method="POST" autocomplete="off" class="d-flex">
            @csrf

            <div class="flex-fill">
                <input type="text" class="form-control" name="title" placeholder="Enter title" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Add List</button>
            </div>
        </form>
    </div>


    @foreach ($lists as $list)
    @include('includes.add_card')
    @include('includes.edit_list')

    @if( ($loop->index+1) % 3 == 1 )
    <div class="row">
        @endif

        <div class="col-xs-12 col-md-4 p-1">
            <div class="p-0 card border-primary mb-3">
                <div class="card-header d-flex justify-content-between"> <b class="mt-2"> {{ $list->title }} </b>
                    <div> <button class="btn btn-secondary" data-toggle="modal" data-target="#edit_list_{{$list->id}}"> <i class="fa fa-pencil"></i> </button> <button class="btn btn-primary" data-toggle="modal" data-target="#add_card_{{$list->id}}">+</button> </div>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        @php $total = $list->cards->count(); $complete = $list->cards->where('completed', '1')->count();
                        if($total > 0)
                        $progress = ($complete/$total)*100;
                        else
                        $progress = 0;
                        @endphp
                        <label> Progress: </label>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$progress}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @foreach ($list->cards as $card)
                        @include('includes.edit_card')
                        @include('includes.add_card_attachment')

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $list->id }}_{{ $card->id }}" aria-expanded="false" aria-controls="collapse{{ $list->id }}_{{ $card->id }}">
                                    @if($card->completed == 0) <input type="checkbox" onclick="window.location.assign('/complete_card/{{$card->id}}');" class="me-2"> @else <input type="checkbox" checked onclick="window.location.assign('/incomplete_card/{{$card->id}}');" class="me-2"> @endif {{ $card->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ $list->id }}_{{ $card->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-flex justify-content-end"> <button class="btn btn-dark me-1" data-toggle="modal" data-target="#edit_card_{{$card->id}}"><i class="fa fa-pencil"></i></button> <a href="/delete_card/{{$card->id}}"> <button class="btn btn-danger"><i class="fa fa-trash"></i></button> </a> </div>
                                    <br>
                                    <strong>Description:</strong>
                                    {{ $card->description }}

                                    <img src="{{ $card->attachment }}" alt="" width="100%">

                                    <div class="d-flex justify-content-end mt-3"> <b class="me-2 mt-2"> Attachment: </b> <button class="btn btn-dark p-1 me-1" data-toggle="modal" data-target="#add_card_attachment{{$card->id}}"> + </button> <a href="{{ $card->attachment }}" download="img.jpg"><button class="btn btn-dark p-1 me-1 "><i class="fa fa-download"></i></button> </a> <a href="/delete_card_attachment/{{$card->id}}"> <button class="btn btn-danger p-1"><i class="fa fa-trash"></i></button> </a> </div>

                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if( ($loop->index+1) % 3 == 0 )
    </div>
    @endif

    @endforeach

</x-app-layout>