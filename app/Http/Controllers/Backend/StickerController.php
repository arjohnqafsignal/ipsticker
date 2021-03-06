<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LettersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\Sticker;

class StickerController extends Controller
{
    public function index(LettersDataTable $dataTable)
    {
        return $dataTable->render('backend.sticker.index');
    }

    public function uploadscan(Request $request)
    {
        $request->validate([
            'RemoteFile' => 'required|mimes:pdf|max:2048',
        ]);

        $request->file('RemoteFile')->storeAs('uploads', 'testfilename.pdf', 'public');
    }
    public function viewletter(Letter $letter)
    {
        $data['letter'] = $letter;
        return view('backend.sticker.viewletter', $data);
    }

    public function viewstickers(Letter $letter)
    {
        $data['stickers'] = $letter->stickers;

        $data['stickers_count'] = sprintf('%02d', count($letter->stickers) + 1);
        $data['letter'] = $letter;
        $data['serialized'] = explode("-", $letter->stickers[0]->serialize);
        return view('backend.sticker.viewstickers', $data);
    }
    public function deleteletter(Letter $letter)
    {
        $deleted = $letter->delete();
        if($deleted){
            return redirect('admin/sticker/generate')->withFlashSuccess('Letter successfully deleted.');
        }
    }

    public function deletesticker(Sticker $sticker)
    {
        $deleted = $sticker->delete();
        if($deleted){
            return redirect()->back()->withFlashSuccess('Sticker successfully deleted.');
        }
    }

    public function printall(Letter $letter)
    {
        $data['stickers'] = $letter->stickers;
        $data['letter'] = $letter;
        return view('backend.sticker.printall', $data);
    }

    public function printsingle(Sticker $sticker)
    {
        $data['sticker'] = $sticker;
        $data['letter'] = $sticker->letter;
        return view('backend.sticker.printsingle', $data);
    }

    public function generate(Request $request)
    {
        $letterCount = Letter::get()->count() + 1;
        $data['letterCode'] = sprintf('%02d', $letterCount);
        $data['stickerCount'] = sprintf('%02d', 1);


        $data['stickers'] = [];
        $data['letterNumber'] = '';

        if($request->session()->exists('stickers'))
        {
            $data['stickers'] = $request->session()->get('stickers');
            $data['stickerCount'] = sprintf('%02d', count($data['stickers']) + 1);
            $stickers = $request->session()->get('stickers');
            if(count($stickers) > 0){
                $data['letterNumber'] = $stickers[0]['letter_number'];
            }
        }

        return view('backend.sticker.generate', $data);
    }

    public function addsticker(Request $request)
    {
        if(!$request->session()->exists('stickers'))
        {
            $request->session()->put('stickers', [$request->except('_token')]);
        }
        else
        {
            $request->session()->push('stickers', $request->except('_token'));
        }
        return redirect('admin/sticker/generate')->withFlashSuccess('Sticker successfully added.');
    }

    public function addstickertoletter(Request $request)
    {
        $newSticker = new Sticker;
        $newSticker->letter_id = $request->letter_id;
        $newSticker->serialize = $request->serialize;
        $newSticker->serial_number = $request->serialize_number;
        $newSticker->sticker_type = $request->sticker_type;
        $newSticker->unit_name = $request->unit_name;
        $newSticker->military_number = $request->military_number;
        $newSticker->rank = $request->rank;
        $newSticker->person_name = $request->person_name;
        $saved = $newSticker->save();
        if($saved)
        {
            return redirect('admin/sticker/viewstickers/'.$request->letter_id)->withFlashSuccess('Sticker successfully added.');
        }
        else
        {
            return redirect('admin/sticker/viewstickers/'.$request->letter_id)->withFlashError('Sticker add failed.');
        }
    }

    public function editsticker(Request $request)
    {
        dd($request->serialize);
        $stickers = $request->session()->get('stickers');
        foreach($stickers as $key => $sticker){
            if($sticker['serialize'] == $request->serialize){
                $keyToDelete = $key;
            }
        }
    }

    public function clearsticker(Request $request)
    {
        $stickers = $request->session()->get('stickers');
        $keyToDelete = 0;
        foreach($stickers as $key => $sticker){
            if($sticker['serialize'] == $request->key){
                $keyToDelete = $key;
            }
        }
        unset($stickers[$keyToDelete]);
        $reindexedSticker = array_values($stickers);
        $request->session()->put('stickers', $reindexedSticker);
        return redirect('admin/sticker/generate')->withFlashSuccess('Sticker successfully removed.');
    }

    public function generatesticker(Request $request)
    {
        $data['stickers'] = $request->session()->get('stickers');
        return view('backend.sticker.print', $data);
    }

    public function savestickers(Request $request)
    {
        $stickers = $request->session()->get('stickers');
        $letter = new Letter();
        $letter->letter_number = $stickers[0]['letter_number'];
        $letter->letter_date = $stickers[0]['letter_date'];
        $letter->file_name = $request->file_name;
        $letter->save();
        $letter_id = $letter->id;

        foreach($stickers as $sticker)
        {
            $newSticker = new Sticker();
            $newSticker->letter_id = $letter_id;
            $newSticker->serialize = $sticker['serialize'];
            $newSticker->serial_number = $sticker['serialize_number'];
            $newSticker->sticker_type = $sticker['sticker_type'];
            $newSticker->unit_name = $sticker['unit_name'];
            $newSticker->military_number = $sticker['military_number'];
            $newSticker->rank = $sticker['rank'];
            $newSticker->person_name = $sticker['person_name'];
            $newSticker->save();
        }
        $request->session()->forget('stickers');
        return redirect('admin/sticker')->withFlashSuccess('Sticker successfully saved.');
    }

}
