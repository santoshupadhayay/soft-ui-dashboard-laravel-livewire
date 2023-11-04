<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Registration;
use DB;
use Illuminate\Http\Request;


class Login extends Component
{
    public $name = null;
    public $age = null;
    public $phone = null;
    public $email = null;
    public $password = null;
    public $remember_me = false;

    protected $rules = [
        // 'email' => 'required|email:rfc,dns',
        'password' => 'required',
    ];

    public function mount() {
        if(auth()->user()){
            redirect('/dashboard');
        }
        $this->fill(['email' => 'admin@kzuniv.com', 'password' => 'secret']);
    }

    

    public function register(Request $request) {
        try{
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'age' => $request->age,
            ];
            $reg = new Registration();
            $reg->fill($data);
            if(!$reg->save()){
                return redirect()->back();    
            }
            session()->put('regId', $reg->id);
            DB::commit();
            return redirect()->route('loadStreams');
        }catch(Exception $e){
            DB::rollBack();
            Log::error("register : ".$e->getMessage());
            return redirect()->back();

        }
    }


    public function login() {
        $credentials = $this->validate();
        if(auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = User::where(["email" => $this->email])->first();
            auth()->login($user, $this->remember_me);
            return redirect()->intended('/dashboard');        
        }
        else{
            return $this->addError('email', trans('auth.failed')); 
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
