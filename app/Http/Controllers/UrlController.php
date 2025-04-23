<?php

namespace App\Http\Controllers;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UrlController extends Controller
{
     // Create a short URL for the provided original URL
     public function createShortUrl(Request $request)
     {
         // Validate the incoming request
         $request->validate([
             'original_url' => 'required|url|max:255',
         ]);
 
         $originalUrl = $request->input('original_url');
         
         // Generate a unique short URL (e.g., a random 6-character string)
         do {
             $shortUrl = Str::random(6);
         } while (Url::where('short_url', $shortUrl)->exists()); // Ensure uniqueness
 
         // Save the original and short URL in the database
         Url::create([
             'original_url' => $originalUrl,
             'short_url' => $shortUrl,
         ]);
 
         return response()->json([
             'original_url' => $originalUrl,
             'short_url' => url($shortUrl),
         ]);
     }
 
     // Redirect to the original URL using the short URL
     public function redirectToOriginalUrl($shortUrl)
     {
         $url = Url::where('short_url', $shortUrl)->first();
 
         if (!$url) {
             return response()->json(['error' => 'Short URL not found'], 404);
         }
 
         return redirect()->to($url->original_url);
     }

     public function showForm()
    {
    return view('short-url');
    }
}
