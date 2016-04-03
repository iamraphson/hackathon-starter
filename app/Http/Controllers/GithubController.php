<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Http\Request;
use Auth;
use App\UserProfile;
use App\Http\Requests;
use GitHub;

class GithubController extends Controller{

    protected $github;
    protected  $githubUsername;
    protected  $githubRepo;

    public function __construct(GitHubManager $github){
        $this->github = $github;
        $this->githubUsername = "iamraphson";
        $this->githubRepo = "hackathon-starter";
        GitHub::setDefaultConnection('alternative');
    }

    public function index(Request $request){
        $tokenData = $this->getGithubToken();
        if(!$tokenData){
            return redirect('auth/github?redirect=' . $request->path());
        } else {
            $repoDetails = GitHub::repo()->show($this->githubUsername, $this->githubRepo);
            return view('api.github')->withDetails($repoDetails);
        }
    }

    private function getGithubToken(){
        return UserProfile::whereProvider('github')->where('user_id', '=', Auth::user()->id)->first();
    }
}
