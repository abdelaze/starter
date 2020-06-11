@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم تعديل البيانات بنجاح
        </div>
        <div class="row">
            <div class="col-md-offset-5 col-md-5">
                <form method="POST" action="" id="offerFormUpdate" enctype="multipart/form-data">
                    @csrf
                   <input type="hidden" value="{{$offer->id}}" name="offer_id">
                    <div class="form-group">
                        <label>{{__('messages.image')}}</label>
                        <input type="file" name="photo" class="form-control"  placeholder="{{__('messages.photo')}}">
                        @error('photo')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer Name en')}}</label>
                        <input type="text" name="name_en" class="form-control" value="{{$offer->name_en}}" placeholder="{{__('messages.Offer Name en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{__('messages.Offer Name ar')}}</label>
                        <input type="text" name="name_ar" class="form-control" value="{{$offer->name_ar}}" placeholder="{{__('messages.Offer Name ar')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer Price')}}</label>
                        <input type="text" name="price" class="form-control" value="{{$offer->price}}" placeholder="{{__('messages.Offer Price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{__('messages.Offer details')}}</label>
                        <input type="text" name="details" class="form-control" value="{{$offer->details}}" placeholder="{{__('messages.Offer details')}}">
                        @error('details')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <button id="update_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
@section("scripts")
    <script>

        $(document).on('click','#update_offer',function (e){
            e.preventDefault();
            // $('#photo_error').text('');
            // $('#name_ar_error').text('');
            // $('#name_en_error').text('');
            // $('#price_error').text('');
            // $('#details_ar_error').text('');
            // $('#details_en_error').text('');
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true ) {
                        $('#success_msg').show();
                    }
                }, error: function (reject) {


                }
            });
        });

    </script>
@stop
