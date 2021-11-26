<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
// php 
class AdminController extends Controller
{
    protected $_data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'name' => 'Trang chủ',
            'key' => 'Trang tổng quan'
        ];
        return view('admin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('admin/login');
    }
    public function login(Request $request) {
        if ($request->input('username')) {
            $userName   = $request->input('username');
            $pass       = $request->input('password');
            if (Auth::attempt(['username' => $userName, 'password' => $pass])) {
                return redirect()->route('admin/home');
            } else {
                return redirect()->route('admin/login');
            }
        } else {
            return view('admin.login');
        }
    }
}
