<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IpSticker;
use App\DataTables\IpStickersDataTable;
class IPStickerController extends Controller
{
    //
    public function index(IpStickersDataTable $dataTable)
    {
        return $dataTable->render('backend.ipsticker.index');
    }

    public function create()
    {
        return view('backend.ipsticker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|unique:ip_stickers|max:255',
            'computer_name' => 'required|unique:ip_stickers|max:255',
            'ip_address' => 'required|unique:ip_stickers|max:255',
        ]);

        $sticker = new IpSticker();

        $sticker->user_name = $request->user_name;
        $sticker->computer_name = $request->computer_name;
        $sticker->ip_address = $request->ip_address;
        $sticker->save();
        if($sticker){
            return redirect('admin/ipsticker')->withFlashSuccess('IP Sticker successfully created.');
        }
    }

    public function generate(Request $request)
    {
        $data['user_name'] = $request->user_name;
        $data['computer_name'] = $request->computer_name;
        $data['ip_address'] = $request->ip_address;
        return view('backend.ipsticker.generate', $data);
    }

    public function view(IpSticker $ipSticker)
    {
        $data['id'] = $ipSticker->id;
        $data['computer_name'] = $ipSticker->computer_name;
        $data['user_name'] = $ipSticker->user_name;
        $data['ip_address'] = $ipSticker->ip_address;

        return view('backend.ipsticker.view', $data);
    }

    public function delete(IpSticker $ipSticker)
    {
        $deleted = $ipSticker->delete();
        if($deleted)
        {
            return redirect('admin/ipsticker')->withFlashSuccess('IP Sticker successfully deleted.');
        }

    }

    public function update(Request $request, IpSticker $ipSticker)
    {
        $request->validate([
            'user_name' => 'required|unique:ip_stickers,id,'.$ipSticker->id.'|max:255',
            'computer_name' => 'required|unique:ip_stickers,id,'.$ipSticker->id.'|max:255',
            'ip_address' => 'required|unique:ip_stickers,id,'.$ipSticker->id.'|max:255',
        ]);

        $ipSticker->user_name = $request->user_name;
        $ipSticker->computer_name = $request->computer_name;
        $ipSticker->ip_address = $request->ip_address;
        $ipSticker->save();
        if($ipSticker){
            return redirect('admin/ipsticker')->withFlashSuccess('IP Sticker successfully updated.');
        }
    }
}
