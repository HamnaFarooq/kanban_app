<x-app-layout>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile pt-4">
                <h1 class="text-light"></h1>
            </div>

            <nav id="navbar" class="nav-menu navbar pt-5">
                <ul>
                    <li><a href="/admin_dashboard" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Home</span></a></li>
                    <li><a href="/admin_lists" class="nav-link scrollto active"><i class="bx bx-user"></i> <span> Lists </span></a></li>
                    <li><a href="/admin_users" class="nav-link scrollto"><i class="bx bx-user"></i> <span> Users </span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <main id="main">

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
            <!-- <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addArea">Add another Area</button> -->
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $list)
                @include('includes.edit_list')
                <tr>
                    <th scope="row"> {{ $loop->index+1 }} </th>
                    <td> {{ $list->title }} </td>
                    <td> <button class="btn btn-primary" data-toggle="modal" data-target="#edit_list_{{$list->id}}" > Edit </button> </td>
                    <td> <a href="/delete_list/{{$list->id}}"> <button class="btn btn-danger">Delete</button> </a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>


</x-app-layout>