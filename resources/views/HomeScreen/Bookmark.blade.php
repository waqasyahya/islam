@extends('HomeScreen.Header-Layout')

<div class="" style="margin-top: 125px;"></div>

<h2 class="text-center">Quaida</h2>
<div class="container">
    @if($bookmarkedItems->isEmpty())
    <p style="text-align: center; font-size: 18px; color: gray;">No bookmarks found.</p>
    @else
    @foreach($bookmarkedItems as $bookmark)
        @if($bookmark->quaida_id) <!-- Only show if quaida_id is not null -->
        <a href="{{ url('quaida-detail/' . optional($bookmark->quaida)->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card shadow-lg mb-4" style="width: 75%; margin: auto;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-left">
                            <p style="font-size: 18px;">{{ optional($bookmark->quaida)->id }}</p>
                        </div>
                        <div class="col-6 text-center">
                            <p style="font-size: 18px;">{{ optional($bookmark->quaida)->Quaida_Words }}</p> <!-- Quaida Words -->
                            <p style="font-size: 16px; color: gray;">{{ optional($bookmark->quaida)->Quaida_Name }}</p> <!-- Quaida Name -->
                        </div>
                        <div class="col-3 text-right">
                            <i class="fa fa-heart" id="heart-{{ optional($bookmark->quaida)->id }}" onclick="toggleBookmark(event, {{ optional($bookmark->quaida)->id }})" style="color: #006d74; font-size: 24px; cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
    @endforeach
    @endif
</div>

<h2 class="text-center">Quran</h2>
<div class="container">
    @if($bookmarkedItemquran->isEmpty())
    <p style="text-align: center; font-size: 18px; color: gray;">No bookmarks found.</p>
    @else
    @foreach($bookmarkedItemquran as $bookmark)
        @if($bookmark->quran_id) <!-- Only show if quran_id is not null -->
        <a href="{{ url('quran-detail/' . optional($bookmark->quran)->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card shadow-lg mb-4" style="width: 75%; margin: auto;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 text-left">
                            <p style="font-size: 18px;">{{ optional($bookmark->quran)->id }}</p>
                        </div>
                        <div class="col-6 text-center">
                            <p style="font-size: 18px;">{{ optional($bookmark->quran)->Quaida_Words }}</p> <!-- Quaida Words -->
                            <p style="font-size: 16px; color: gray;">{{ optional($bookmark->quran)->Quaida_Name }}</p> <!-- Quaida Name -->
                        </div>
                        <div class="col-3 text-right">
                            <i class="fa fa-heart" id="heart-{{ optional($bookmark->quran)->id }}" onclick="toggleBookmark(event, {{ optional($bookmark->quran)->id }})" style="color: #006d74; font-size: 24px; cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
    @endforeach
    @endif
</div>
