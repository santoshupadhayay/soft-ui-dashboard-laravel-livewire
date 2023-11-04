<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use App\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\GoogleDriveController;


class EditChapter extends Component
{
    public function render(Request $request)
    {   
        $id = request('id');
        $streams = Stream::all();
        $chapter = Chapter::find($id);
        return view('livewire.chapters.editChapter')->with(compact('chapter','streams'));
    }

    public function updateChapter(Request $request)
    {
        try{
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('chapter_files', $fileName, 'public');
                $filenameToStore = '/storage/' . $filePath;

                $gController = new GoogleDriveController();
                $link = $gController->uploadFile($request);
            }
    
            $chapter = Chapter::find($request->id);
            $data = [
                'name' => $request->name,
                'status' => isset($request->status) ? true : false,
                'stream_id' => $request->stream_id,
                'comtent' => $request->description,
                'has_quiz' => isset($request->has_quiz) ? true : false,
                'drive_link' => isset($link) ? $link : null,
            ];
            if(isset($filenameToStore)){
                $data['file'] = $filenameToStore;
            }
            $chapter->fill($data);
            $chapter->save();
            return redirect()->route('chapters');
        }catch(Exception $e){
            Log::error("updateChapter : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
