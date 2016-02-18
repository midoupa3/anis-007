<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\NouveauPDV;
use App\Http\Requests\Admin\NouveauPDVRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class NouveauPDVController extends AdminController {

    public function __construct()
    {
        view()->share('type', 'nouveaupdv');
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('admin.nouveaupdv.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       // Show the page
        return view('admin/nouveaupdv/create_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NouveauPDVRequest $request)
	{
        $nouveaupdv = new NouveauPDV($request->all());
        $nouveaupdv -> user_id = Auth::id();
        $nouveaupdv -> save();
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(NouveauPDV $nouveaupdv)
	{
        return view('admin/nouveaupdv/create_edit',compact('nouveaupdv'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(NouveauPDVRequest $request, NouveauPDV $nouveaupdv)
	{
        $nouveaupdv -> user_id_edited = Auth::id();
        $nouveaupdv -> update($request->all());
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function delete(NouveauPDV $nouveaupdv)
    {
        // Show the page
        return view('admin/nouveaupdv/delete', compact('nouveaupdv'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy(NouveauPDV $nouveaupdv)
    {
        $nouveaupdv->delete();
    }

    /**
     * Show a list of all the nouveaupdv posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $nouveaupdv = NouveauPDV::select(array('nouveaupdv.pdv', 'nouveaupdv.raison_sociale', 'nouveaupdv.type_pdv','nouveaupdv.adresse_pdv','nouveaupdv.wilaya_pdv','nouveaupdv.commune_pdv','nouveaupdv.msisdn','nouveaupdv.autre_telephone_pdv','nouveaupdv.email_pdv','nouveaupdv.code_pdv','nouveaupdv.Statue'))->get();
        return Datatables::of($nouveaupdv)
            
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/nouveaupdv/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/nouveaupdv/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }

}
