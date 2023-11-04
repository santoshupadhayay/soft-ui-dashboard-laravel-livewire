<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stream;
use Illuminate\Http\Request;

class EditStream extends Component
{
    public function render(Request $request)
    {   
        $id = request('id');
        $stream = Stream::find($id);
        return view('livewire.streams.editStream')->with(compact('stream'));
    }

    public function updateStream(Request $request)
    {
        try{
            if($request->icon!=null) {
                $fileName = time().'_'.$request->icon->getClientOriginalName();
                $filePath = $request->file('icon')->storeAs('stream_icons', $fileName, 'public');
                $filenameToStore = '/storage/' . $filePath;
            }
    
            $stream =   Stream::find($request->id);
            $data = [
                'name' => $request->name,
                'status' => isset($request->status) ? true : false,
                'description' => $request->description,
            ];
            if(isset($filenameToStore)){
                $data['icon'] = $filenameToStore;
            }
            $stream->fill($data);
            $stream->save();
            return redirect()->route('streams');
        }catch(Exception $e){
            Log::error("saveStream : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
