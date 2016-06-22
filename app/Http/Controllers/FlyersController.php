<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FlyersController extends Controller
{

    function __construct() {
        $this->middleware('auth', ['except' => ['show']]);
        parent::__construct();
    }

    public function index()
    {
        return view('flyers.index');
    }

    public function create()
    {
    	return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        // persist the flyer
        Flyer::create($request->all());

        // flash messaging
        flash()->success('success','Your flyer has been created');

        return redirect()->back();
    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp,gif'
        ]);

        if( !$this->userCreatedFlyer($request) ){
            return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Done';
    }

    protected function unauthorized(Request $request)
    {
        
        if( $request->ajax() ){
            return response(['message' => 'no way'], 403);
        }

        flash('No way');

        return redirect('/');

    }
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'street' => $request->street,
            'zip'   => $request->zip,
            'user_id' => $this->user->id
            ])->exists();
    }

    public function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);

    }
}