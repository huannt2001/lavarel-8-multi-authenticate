@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br>
                    <img class="card-img-top" style="border-radius: 50%" alt="User Image"
                        src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}"
                        height="100px" width="100px"><br><br>

                    <ul class="list-group list-group-flush">
                        <a href="{{ route('user.home') }}" class="btn btn-primary btn-sm btn-block">Home</a>

                        <a href="{{ route('user.order') }}" class="btn btn-primary btn-sm btn-block">Order</a>

                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>

                        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password
                        </a>

                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

                    </ul>

                </div> <!-- // end col md 2 -->

                <div class="col-md-2">

                </div> <!-- // end col md 2 -->


                <div class="col-md-8">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Your order
                        </h3>
                        <table class="table table-response">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Body</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="col">1</td>
                                    <td scope="col">Mark 1</td>
                                    <td scope="col">Mark 2</td>
                                    <td scope="col">Mark 3</td>
                                </tr>
                                <tr>
                                    <td scope="col">1</td>
                                    <td scope="col">Mark 1</td>
                                    <td scope="col">Mark 2</td>
                                    <td scope="col">Mark 3</td>
                                </tr>
                                <tr>
                                    <td scope="col">1</td>
                                    <td scope="col">Mark 1</td>
                                    <td scope="col">Mark 2</td>
                                    <td scope="col">Mark 3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div> <!-- // end col md 6 -->

            </div> <!-- // end row -->

        </div>

    </div>
@endsection
