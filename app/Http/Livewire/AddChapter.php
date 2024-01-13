<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use App\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\GoogleDriveController;

class AddChapter extends Component
{
    public function render()
    {
        $streams = Stream::all();
        return view('livewire.chapters.addChapter')->with(compact('streams'));
    }

    public function saveChapter(Request $request)
    {
        try{
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('chapter_files', $fileName, 'public');
                $filenameToStore = '/storage/' . $filePath;

                // $gController = new GoogleDriveController();
                // $gController->uploadFile($request);
            }
    
            $chapter = new Chapter();
            $data = [
                'name' => $request->name,
                'file' => $filenameToStore,
                'status' => isset($request->status) ? true : false,
                'stream_id' => $request->stream_id,
                'comtent' => $request->description,
                'has_quiz' => isset($request->has_quiz) ? true : false,
            ];
            $chapter->fill($data);
            $chapter->save();
            return redirect()->route('chapters');
        }catch(Exception $e){
            Log::error("saveChapter : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
