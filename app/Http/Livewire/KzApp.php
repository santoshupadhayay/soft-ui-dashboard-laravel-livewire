<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stream;
use App\Models\Chapter;
use App\Models\Registration;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use PDF;

class KzApp extends Component
{
    public function render()
    {
        Session::forget('regId');
        return view('livewire.kz-app');
    }

    public function loadStreams()
    {
        $streams = Stream::where('status',true)->get();
        // dd($streams);
        return view('livewire.kzapp-streams')->with(compact('streams')) ;
    }

    public function loadChapters($id){
        $chapters = Chapter::where('stream_id',$id)->get();        
        return view('livewire.kzapp-chapters')->with(compact('chapters')) ;
    }

    public function viewChapter($id){        
        $chapter = Chapter::where('id',$id)->first();
        if($chapter->file != null){
            $path = public_path($chapter->file);
            $mimeType = mime_content_type($path);
            if(in_array($mimeType , ['application/vnd.oasis.opendocument.presentation','application/vnd.openxmlformats-officedocument.presentationml.presentation'])){
                $chapter->mimeType = 'ppt';
            } else if($mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                $chapter->mimeType = 'word';
            }  else if(in_array($mimeType, ['image/jpeg','image/png','image/gif'])){
                $chapter->mimeType = 'image';
            }  else if(in_array($mimeType, ['text/html'])){
                $chapter->mimeType = 'html';
            }   else if(in_array($mimeType, ['application/pdf'])){
                $chapter->mimeType = 'pdf';
            } else {
                $chapter->mimeType = null;
            } 
        }
        $reg = Registration::find(session('regId'));
        $reg->stream_id = $chapter->stream_id;
        $reg->save();
        $hasQuiz = Quiz::where('chapter_id', $id)->first();
        $hasNextChapter = Chapter::where('stream_id',$chapter->stream_id)->where('id','>',$chapter->id)->first();
        return view('livewire.kzapp-chapter')->with(compact('chapter','hasQuiz','hasNextChapter')) ;
    }

    public function createCertficate(){        
        $reg = Registration::find(session('regId'));
        // $hasQuiz = Quiz::where('chapter_id', $id)->first();
        // $haschapter = Chapter::where('stream_id',$chapter->stream_id)->where('id','>',$chapter->id)->first();        
        return view('livewire.kz-creaetCertificate')->with(compact('reg')) ;
    }

    public function uploadCertificateImage(Request $request){
        
        if ($request->has('image_data')) {
            $base64Image = $request->input('image_data');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
    
            // Save the image data as a file
            $filename = 'certificates/certificate_'.session('regId').'_' . time() . '.png';
            Storage::disk('public')->put($filename, $imageData); // Store the image in the 'public' disk
    
            // Save the file path to the database
            // $image = new Image();
            // $image->path = 'storage/' . $filename; // Adjust the path as needed
            // $image->save();
        }    

        
        $reg = Registration::find(session('regId'));
        $reg->certificate = $filename;
        $reg->save();
        return view('livewire.kz-viewCertificate')->with(compact('reg')) ;
    }
    public function printCertificate(Request $request){

        $reg = Registration::where('id',session('regId'))->first();
        $stream = Stream::find($reg->stream_id);
        $reg->stream = $stream->name;
        return view('livewire.kz-viewCertificate')->with(compact('reg')) ;
    }

    public function appQuiz($id){
        $quiz = Quiz::where('id', $id)->first();
        $questions = Quiz::questionsWithOptions($id);
        $haschapter = Chapter::where('stream_id',$quiz->stream_id)->where('id','>',$quiz->chapter_id)->first();
        return view('livewire.kzapp-quiz')->with(compact('quiz','haschapter','questions')) ;
    }

    public function loadPPT()
    {
        // Replace 'your-file.pptx' with the actual file name and path
        $pptFilePath = 'D:\kzuniv\storage\app\public\chapter_files\1699079459_1699074244_1699073138_CONFOCAL MICROSCOPY (4).pptx';

        // Use the Storage facade to retrieve the file
        $file = Storage::disk('public')->get($pptFilePath);

        // Set the appropriate content type for a PowerPoint file
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ];

        return response($file, 200, $headers);
    }


    
}
