<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Redirect;



class LinkController extends Controller
{
    public function create(Request $request)
    {
        $link = new Link;
        $link->title_link = $request->input('title_link');
        $link->redirect_url = $request->input('redirect_url');
        $link->save();

        return response()->json(['success' => true]);
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

        return response()->json(['success' => true]);
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
    
    public function listSublinks($link_id)
    {
        $sublinks = Redirect::where('link_id', $link_id)->get();

        return response()->json([
            'sublinks' => $sublinks
        ]);
    }


    public function updateSublink(Request $request, $link_id, $sublink_id)
    {
        $sublink = Redirect::where('id', $sublink_id)->where('link_id', $link_id)->first();

        if (!$sublink) {
            return response()->json([
                'error' => 'Sublink not found'
            ], 404);
        }

        $sublink->url = $request->input('url');
        $sublink->max_click = $request->input('max_click');
        $sublink->save();

        return response()->json([
            'sublink' => $sublink
        ]);
    }

    public function deleteSublink($link_id, $sublink_id)
    {
        $sublink = Redirect::where('id', $sublink_id)->where('link_id', $link_id)->first();

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
}
