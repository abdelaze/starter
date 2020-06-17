@extends("layouts.app")
@section("content")
    <div class="container">

        <div class="row">

            <h2 class="text-center"> all hospitals</h2>

            <table class="table table-bordered table-light">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>

                @if(isset($hospitals) && $hospitals->count()>0)
                @foreach($hospitals as $hospital)
                    <tr class="offerRow{{$hospital->id}}">
                        <th scope="row">{{$hospital-> id}}</th>
                        <th scope="row">{{$hospital-> hospital_name}}</th>
                        <td>{{$hospital -> address}}</td>

                        <td>
                            <a class="btn btn-success" href="{{route('hospital.doctors',$hospital->id)}}">Print All Doctors</a>
                            <a class="btn btn-danger" href="{{route('hospital.delete',$hospital->id)}}">Delete</a>


                        </td>

                    </tr>
                @endforeach
                @endif

                </tbody>






            </table>
        </div>
    </div>
@stop
