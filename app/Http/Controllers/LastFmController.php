<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Dandelionmood\LastFm\LastFm;
use Auth;


class LastFmController extends Controller{

    protected $lastFm;
    protected $artist;

    public function __construct(){
        $this->lastFm = new LastFm(env('LASTFM_ID'), env('LASTFM_SECRET'));
        $this->artist = "Rihanna";
    }

    public function index(Request $request){
        $details = array();

        $artistInfo = $this->getArtistInfo();
        $details['name'] = $artistInfo->artist->name;
        $details['image'] = $artistInfo->artist->image[5]->{'#text'};
        $details['tags'] = $artistInfo->artist->tags->tag;
        $details['bio'] = $artistInfo->artist->bio->summary;
        $details['stats'] = $artistInfo->artist->stats;
        $details['similar'] = $artistInfo->artist->similar->artist;
        $details['topAlbums'] = array_slice($this->getTopAlbums(), 0, 6);
        $details['topTracks'] = array_slice($this->getTopTracks(), 0, 6);

        return view('api.lastfm')->withArtist($details);
    }

    private function  getArtistInfo(){
        return $this->lastFm->artist_getInfo(
            array('artist' => $this->artist)
        );
    }

    private function getTopAlbums(){
        $result = (array)$this->lastFm->artist_getTopAlbums(
                            array('artist' => $this->artist)
                        );
        return $result['topalbums']->album;
    }



    private function getTopTracks(){
        $result = (array)$this->lastFm->artist_getTopTracks(
                            array('artist' => $this->artist)
                        );
        return $result['toptracks']->track;
    }
}
