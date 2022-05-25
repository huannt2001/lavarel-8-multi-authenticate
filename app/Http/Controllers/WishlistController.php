<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Wishlist;
use DB;
use Auth;

class WishlistController extends Controller
{
    public function AddToWishlist($id) {
        $user_id = Auth::id();
        if(Auth::check()) {
            $check = Wishlist::where('user_id', $user_id)->where('product_id', $id)->first();
            if (!$check) {
                Wishlist::insert([
                    'user_id' => $user_id,
                    'product_id' => $id
                ]);

               return response()->json([
                    'success' => 'Product Added on Wishlist'
               ]);

            } else {
                return response()->json([
                    'error' => 'Already Added on Wishlist'
                ]);
            }

        } else {
            return response()->json([
                'error' => 'At First Login Your Account'
            ]);
        }
    }
}
