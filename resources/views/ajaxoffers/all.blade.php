@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم حذف البيانات بنجاح
        </div>
      <div class="row">
          <br><br>
          <a class="btn btn-primary" href="{{url('ajax-offers/create')}}">{{__('messages.create')}}</a>
          <br><br>
          <table class="table table-bordered table-light">
              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">{{__('messages.OFFER NAME')}}</th>
                  <th scope="col">{{__('messages.Offer Price')}}</th>
                  <th scope="col">{{__('messages.Offer details')}}</th>
                  <th scope="col">{{__('messages.Offer Photo') }}</th>
                  <th scope="col">{{__('messages.operation')}}</th>
              </tr>
              </thead>
              <tbody>


              @foreach($offers as $offer)
                  <tr class="offerRow{{$offer->id}}">
                      <th scope="row">{{$offer -> id}}</th>
                      <td>{{$offer -> name}}</td>
                      <td>{{$offer -> price}}</td>
                      <td>{{$offer -> details}}</td>
                      <td> <img class="img-thumbnail img-responsive center-block" style="width:50px;height: 50px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

                      <td>
                          <a class="btn btn-success" href="{{url('offers/edit/'.$offer->id)}}">{{__('messages.update')}}</a>
                          <a class="btn btn-danger" href="{{route('offers.delete',$offer->id)}}">{{__('messages.delete')}}</a>
                          <a class="delete_offer btn btn-danger" offer_id="{{$offer->id}}" href="">حذف بالاجاكس</a>
                          <a class="btn btn-danger"  href="{{route('ajax.offers.edit',$offer->id)}}">تعديل بالاجاكس</a>

                      </td>

                  </tr>
              @endforeach

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
