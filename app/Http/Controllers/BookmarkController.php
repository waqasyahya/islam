<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Quaida;
use App\Models\Quran;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function showBookmarks()
    {
        // Fetch all bookmarked Quaida items
        $bookmarkedItems = Bookmark::with('quaida')->get();
        $bookmarkedItemquran = Bookmark::with('quran')->get();

        return view('HomeScreen.bookmark', compact('bookmarkedItems', 'bookmarkedItemquran'));
    }



    public function toggleBookmark(Request $request)
    {
        // Validate that one of the required fields is present
        $validated = $request->validate([
            'quran_id' => 'nullable|integer|exists:qurans,id',
            'quaida_id' => 'nullable|integer|exists:quaidas,id',
        ]);

        $quranId = $request->input('quran_id');
        $quaidaId = $request->input('quaida_id');

        if ($quranId) {
            // Toggle Quran bookmark
            $bookmark = Bookmark::where('quran_id', $quranId)->first();
            if ($bookmark) {
                $bookmark->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Bookmark::create(['quran_id' => $quranId]);
                return response()->json(['status' => 'added']);
            }
        } elseif ($quaidaId) {
            // Toggle Quaida bookmark
            $bookmark = Bookmark::where('quaida_id', $quaidaId)->first();
            if ($bookmark) {
                $bookmark->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Bookmark::create(['quaida_id' => $quaidaId]);
                return response()->json(['status' => 'added']);
            }
        }

        return response()->json(['status' => 'error'], 400); // Error if neither ID is provided
    }

        }




    // public function toggleBookmarkQuran(Request $request)
    // {
    //     $quranId = $request->input('quran_id');

    //     // Check if the bookmark already exists
    //     $bookmark = Bookmark::where('quran_id', $quranId)->first();

    //     if ($bookmark) {
    //         // If bookmark exists, remove it
    //         $bookmark->delete();

    //         // Also update the `bookmarked` column in `quaidas` table
    //         $quran = Quran::find($quranId);
    //         $quran->bookmarked = false;
    //         $quran->save();

    //         return response()->json(['status' => 'removed']);
    //     } else {
    //         // If bookmark doesn't exist, add it
    //         Bookmark::create([
    //             'quran_id' => $quranId,
    //         ]);

    //         // Update the `bookmarked` column in `quaidas` table
    //         $quranId = Quran::find($quranId);
    //         $quranId->bookmarked = true;
    //         $quranId->save();

    //         return response()->json(['status' => 'added']);
    //     }
    // }


