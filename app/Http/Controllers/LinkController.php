<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;




class LinkController extends Controller
{
    public function create(Request $request)
    {
        $link = new Link;
        $link->title_link = $request->input('title_link');
        $link->redirect_url = $request->input('redirect_url');
        $link->save();
        return response()->json(['success' => true, 'link' => $link]);
        
    }

    public function index()
    {
        $links = Link::all();
        return response()->json(['links' => $links]);
        
    }

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->title_link = $request->input('title_link');
        $link->redirect_url = $request->input('redirect_url');
        $link->save();
        
        
        
        return response()->json(['success' => true,'link' => $link]);
    }

    public function deleteLink($id)
    {
        Link::findOrFail($id)->delete();
        return response()->json(['message' => 'Link deleted com Sucesso']);
    }

    //Controller Das URLs

    public function createSub(Request $request, $id)
    {
        $redirect = new Redirect;
        $redirect->url = $request->input('url');
        $redirect->max_click = $request->input('max_click');
        $redirect->link_id = $id;
    
        $redirect->save();
        
        return response()->json(['success' => true, 'redirect' => $redirect]);
    }
    
    public function listSublinks($id)
{
    $redirect = Redirect::where('link_id', $id)->get();
    
    return response()->json(['sublinks' => $redirect]);
}


public function updateSublink(Request $request, $id, $id_sub)
{
    $sublink = Redirect::where('id', $id_sub)->where('link_id', $id)->first();
    
    if (!$sublink) {
        return response()->json([
            'error' => 'Sublink not found'
        ], 404);
    }

    $sublink->url = $request->input('url');
    $sublink->max_click = $request->input('max_click');
    $sublink->save();
    return response()->json(['sublink' => $sublink]);
}


    public function deleteSublink($id, $id_sub)
    {
        $sublink = Redirect::where('id', $id_sub)->where('link_id', $id)->first();

        if (!$sublink) {
            return response()->json([
                'error' => 'Sublink not found'
            ], 404);
        }

        $sublink->delete();

        return response()->json([
            'message' => 'Sublink deleted successfully'
        ]);
    }

    //contador de cliques
    public function updateClickCount($id,$id_sub)
{
    $sublink = Redirect::where('id', $id_sub)->where('link_id', $id)->first();
    if (!$sublink) {
        return response()->json([
            'error' => 'Sublink not found'
        ], 404);
    }
    $sublink->current_click++;
    $sublink->save();
    
    return response()->json(['current_click' => $sublink->current_click]);
}

    

}
