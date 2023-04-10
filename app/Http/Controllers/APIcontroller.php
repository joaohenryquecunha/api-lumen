<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class APIcontroller extends Controller
{
//Controllers Dos Links

    public function createlink(Request $params){
        $data = $params->all();
        $link = new Link();
        $link->title_link = $data['link'];
        $link->redirect_url = $data['redirect'];
        $link->save();
        return response()->json(['message' => 'Link Criado com Sucesso!']);
    }

    public function listaLink(){
        $link =  Link::all();
        return $link;

    }

    public function updateLink(Request $params,$id ){
        $data=$params->all();
        $newlink = array();
        $newlink['title_link'] = $data['link'];
        $newlink['redirect_url'] = $data['redirect'];
        Link::findOrFail($id)->update($newlink);
        return response()->json(['message' => 'Link Atualizado com Sucesso!']);
    }

    public function deleteLink($id)
    {
        Link::findOrFail($id)->delete();
        return response()->json(['message' => 'Link deleted com Sucesso']);
    }

//Controller Das URLs

    public function createurl(Request $params, $id){
        $data = $params->all();
        $redirect = new Redirect();
        $redirect->url = $data['url'];
        $redirect->link_id = $id;
        $redirect->max_click = $data['max_click'];
        $redirect->save();
        $resultado = DB::table('redirect')->where('link_id', $id)->sum('max_click');
        $link = Link::findOrFail($id); 
        $link->maximum_cliks = $resultado;
        $link->save();
        return response()->json(['message' => 'URL criada com Sucesso!']);
    }

    public function listaurl($id){
        $redirects = Redirect::where('link_id', '=', $id)->get();
        return $redirects;
    }


    public function updateurl(Request $params,$id ){
        $data=$params->all();
        $newredirect = array();
        $newredirect['url'] = $data['url'];
        Redirect::findOrFail($id)->update($newredirect);
        return response()->json(['message' => 'Link Atualizado com Sucesso!']);
    }

    public function deleteurl($id)
    {
        Redirect::findOrFail($id)->delete();
        return response()->json(['message' => 'Link deleted com Sucesso']);
    }
}

