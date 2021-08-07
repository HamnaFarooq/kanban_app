<x-app-layout>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile pt-4">
                <h1 class="text-light"></h1>
            </div>

            <nav id="navbar" class="nav-menu navbar pt-5">
                <ul>
                    <li><a href="/admin_dashboard" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
                    <li><a href="/admin_lists" class="nav-link scrollto"><i class="bx bx-user"></i> <span> Lists </span></a></li>
                    <li><a href="/admin_users" class="nav-link scrollto"><i class="bx bx-user"></i> <span> Users </span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <main id="main">

        <h2 class="mb-2"> Lists </h2>

        @foreach ($lists as $list)

        @if( ($loop->index+1) % 3 == 1 )
        <div class="row">
            @endif

            <div class="col-xs-12 col-md-4 p-1">
            <div class="p-0 card border-primary mb-3">
                <div class="card-header d-flex justify-content-between"> <b class="mt-2"> {{ $list->title }} </b>
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

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $list->id }}_{{ $card->id }}" aria-expanded="false" aria-controls="collapse{{ $list->id }}_{{ $card->id }}">
                                    @if($card->completed == 0) <input type="checkbox" onclick="return false;" class="me-2"> @else <input type="checkbox" checked onclick="return false;" class="me-2"> @endif {{ $card->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ $list->id }}_{{ $card->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Description:</strong>
                                    {{ $card->description }}

                                    <img src="{{ $card->attachment }}" alt="" width="100%">
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


    </main>


</x-app-layout>