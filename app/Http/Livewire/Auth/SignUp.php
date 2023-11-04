<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Stream;
use App\Models\Chapter;
use Illuminate\Support\Facades\Hash;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email:rfc,dns|unique:users',
        'password' => 'required|min:6'
    ];

    public function mount() {
        if(auth()->user()){
            redirect('/dashboard');
        }
    }

    public function register() {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect('/dashboard');
    }

    public function render()
    {
        $streams = Stream::where('status',true)->get();
        return view('livewire.auth.sign-up')->with(compact('streams')) ;
    }

    public function loadChapters($id){
        
        $chapters = Chapter::where('stream_id',$id)->get();        
        return view('livewire.auth.sign-up')->with(compact('chapters')) ;
    }
}
