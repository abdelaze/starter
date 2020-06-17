@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم اضافة البيانات بنجاح
        </div>
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <form method="POST" action="" id="offerForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>{{__('messages.image')}}</label>
                        <input type="file" name="photo" class="form-control"  placeholder="{{__('messages.photo')}}">

                        <small id="photo_error" class="form-text text-danger"></small>

                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer Name en')}}</label>
                        <input type="text" name="name_en" class="form-control" value="{{old('name_en')}}" placeholder="{{__('messages.Offer Name en')}}">
                        <small id="name_en_error" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Offer Name ar')}}</label>
                        <input type="text" name="name_ar" class="form-control" value="{{old('name_ar')}}" placeholder="{{__('messages.Offer Name ar')}}">
                        <small id="name_ar_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer Price')}}</label>
                        <input type="text" name="price" class="form-control" value="{{old('price')}}" placeholder="{{__('messages.Offer Price')}}">
                        <small id="price_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer details')}}</label>
                        <input type="text" name="details" class="form-control" value="{{old('details')}}" placeholder="{{__('messages.Offer details')}}">
                        <small id="details_error" class="form-text text-danger"></small>
                    </div>


                    <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section("scripts")
    <script>

         $(document).on('click','#save_offer',function (e){
             e.preventDefault();
             $('#photo_error').text('');
             $('#name_en_error').text('');
             $('#name_ar_error').text('');
             $('#price_error').text('');
             $('#details_error').text('');

             var formData = new FormData($('#offerForm')[0]);
             $.ajax({
                 type: 'post',
                 enctype: 'multipart/form-data',
                 url: "{{route('ajax.offers.store')}}",
                 data: formData,
                 processData: false,
                 contentType: false,
                 cache: false,
                 success: function (data) {
                      if(data.status == true ) {
                          $('#success_msg').show();
                      }
                 }, error: function (reject) {
                     
                     var response = $.parseJSON(reject.responseText);
                     $.each(response.errors, function (key, val) {
                         $("#" + key + "_error").text(val[0]);
                     });
                 }
             });
         });

    </script>
@stop
