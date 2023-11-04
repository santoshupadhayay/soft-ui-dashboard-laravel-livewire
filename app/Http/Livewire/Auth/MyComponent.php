<?php


namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Stream;
use Illuminate\Http\Request;

class MyComponent extends Component
{
    public function render()
    {
        return view('livewire.auth.my-component');
    }

    public function saveStream(Request $request)
    {
        try{
            if($request->file()) {
                $fileName = time().'_'.$request->icon->getClientOriginalName();
                $filePath = $request->file('icon')->storeAs('stream_icons', $fileName, 'public');
                $filenameToStore = '/storage/' . $filePath;
            }
    
            $stream = new Stream();
            $data = [
                'name' => $request->name,
                'icon' => $filenameToStore,
                'status' => isset($request->status) ? true : false,
                'description' => $request->description,
            ];
            $stream->fill($data);
            $stream->save();
            return redirect()->route('streams');
        }catch(Exception $e){
            Log::error("saveStream : ".$e->getMessage());
            return redirect()->back();

        }

    }

    

    
}
