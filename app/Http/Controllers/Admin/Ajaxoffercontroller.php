<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class Ajaxoffercontroller extends Controller
{
     use OfferTrait;
     public function create(){
          return view("ajaxoffers.create");
     }
     public function store(Request $request) {

         $file_name = $this->saveImage($request->photo,'images/offers');
        $offer = Offer::create([
             'photo'   => $file_name,
             'name_en' => $request->name_en,
             'name_ar' => $request->name_ar,
             'price' => $request->price,
             'details' => $request->details,

         ]);

         if($offer){
             return response()->json([
                 'status'=>true,
                 'msg' => __('messages.success'),
             ]);
         } else {
             return response()->json([
                 'status'=>false,
                 'msg' => __('messages.error'),
             ]);
         }


     } //end store

    public function getallOffers()
    {
        $offers = Offer::select('id','photo',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details'
        )->get();
        // return collection of all result*/


        return view('ajaxoffers.all', compact('offers'));


    }

    public function delete(Request $request) {
        $offer = Offer::find($request->id);
        if (!$offer)
            return response()->json([
                'status'=>false,
                'msg' => __('messages.error'),

            ]);

        $offer->delete();
        return response()->json([
            'status'=>true,
            'msg' => __('messages.success'),
            'id' => $request->id,
        ]);

    }

    public function edit($offer_id) {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return response()->json([
                'status'=>false,
                'msg' => __('messages.error'),

            ]);
        }
        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details')->find($offer_id);
        return view('ajaxoffers.edit', compact('offer'));
    }

    public function  update(Request $request) {


        $offer = Offer::find($request->offer_id);

        if(!$offer) {
            return response()->json([
                'status'=>false,
                'msg' => __('messages.error'),

            ]);
        }

        // update all data
        $offer->update($request->all());
        return response()->json([
            'status'=>true,
            'msg' => __('messages.error'),

        ]);
    }

} // class endd
