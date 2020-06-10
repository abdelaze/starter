<?php

namespace App\Http\Controllers;

use App\Events\VideoViewers;
use App\Http\Requests\OfferRequest;
use App\models\Offer;
use App\models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
use Illuminate\Validation\Rule;
class OffersController extends Controller
{
    use OfferTrait;
    public function create()
    {
        //view form to add this offer
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {

//          $rules = $this->getRules();
//          $messages = $this->getMessages();
//        $validator = Validator::make($request->all() ,$rules, $messages);
//        if ($validator->fails()) {
//
//            return redirect()->back()->withErrors($validator)->withInputs($request->all());
//
//        }
        // the validation code in request
        $file_name = $this->saveImage($request->photo,'images/offers');
        Offer::create([
            'photo'   => $file_name,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'details' => $request->details,

        ]);

        return redirect()->back()->with(['success' => __('messages.success')]);

    }

    public function getallOffers()
    {
        $offers = Offer::select('id','photo',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details'
        )->get();
        // return collection of all result*/


        return view('offers.all', compact('offers'));


    }

    public function edit($offer_id) {

        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }
        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details')->find($offer_id);
        return view('offers.edit', compact('offer'));
}
public function delete($offer_id) {
    $offer = Offer::find($offer_id);
    if (!$offer)
        return redirect()->back()->with(['error'=>__('messages.Offer Not Exist')]);

     $offer->delete();
    return redirect()->route('offers.all')->with(['success'=>__('messages.Offer Deleted Successfully')]);

}

   public function  update(OfferRequest $request,$offer_id) {


           $offer = Offer::find($offer_id);

           if(!$offer) {
               return redirect()->back();
           }

           // update all data
           $offer->update($request->all());
           return redirect()->back()->with('success','تم تحديث الداتا بنجاح');
   }

   public function getVideos() {
         $video = Video::first();
         event(new VideoViewers($video));
         return view('youtube')->with('video' ,$video);
   }

//    protected  function getRules() {
//
//        return $rules = [
//            'name' => 'required|max:100|unique:offers,name',
//            'price' => 'required|numeric',
//            'details' => 'required',
//        ];
//
//    }
//    protected  function getMessages() {
//        return $messages = [
//            'name.required' => __('messages.offer name required'),
//            'name.unique' => __('messages.offer name must be unique'),
//            'price.numeric' => __('messages.offer price numeric'),
//            'price.required' => __('messages.offer price required'),
//            'details.required' => __('messages.offer details required'),
//        ];
//    }
}
