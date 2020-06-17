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
                    <th scope="col">Title</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>


                @if(isset($doctors) && $doctors->count()>0)
                    @foreach($doctors as $doctor)
                        <tr class="offerRow{{$doctor->id}}">
                            <td scope="row">{{$doctor-> id}}</td>
                            <td scope="row">{{$doctor-> name}}</td>
                            <td>{{$doctor->title}}</td>
                            <td>{{$doctor->gender}}</td>
                            <td>
                                <a class="btn btn-success" href="{{route('doctor.services',$doctor->id)}}">طباعة الخدمات</a>
                            </td>



                        </tr>
                    @endforeach
                @endif

                </tbody>






            </table>
        </div>
    </div>
@stop
@section("scripts")
    <script>
        $(document).on('click','.delete_offer',function (e){
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{route('ajax.offers.delete')}}",
                data:{
                    '_token': "{{csrf_token()}}",
                    'id' : offer_id,
                },

                success: function (data) {
                    if(data.status == true ) {
                        $('#success_msg').show();

                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {


                }
            });
        });

    </script>
@stop
