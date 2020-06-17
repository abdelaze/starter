@extends("layouts.app")
@section("content")
    <div class="container">

        <div class="row">
            <h2>All Doctors</h2>
            <table class="table table-bordered table-light">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>

                </tr>
                </thead>
                <tbody>


                @if(isset($services) && $services->count()>0)
                    @foreach($services as $service)
                        <tr class="offerRow{{$service->id}}">
                            <td scope="row">{{$service-> id}}</td>
                            <td scope="row">{{$service-> name}}</td>

                        </tr>
                    @endforeach
                @endif

                </tbody>


            </table>

            <form method="POST" action="{{route('doctor.services.store')}}"  enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>اختر طبيب</label>
                    @if(isset($doctors) && $doctors->count()>0)
                   <select name="doctorId" class="form-control">

                           @foreach($doctors as $doctor)
                           <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                           @endforeach

                   </select>
                    @endif

                </div>
                <div class="form-group">
                    <label>اختر خدمة</label>
                    @if(isset($allServices) && $allServices->count()>0)
                        <select name="servicesIds[]" class="form-control" multiple>

                            @foreach($allServices as $serv)
                                <option value="{{$serv->id}}">{{$serv->name}}</option>
                            @endforeach

                        </select>
                    @endif

                </div>




                <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
            </form>


        </div>
    </div>
@stop
