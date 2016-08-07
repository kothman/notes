<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Route;
use Auth;
use Validator;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\SettingsForm;
use App\Forms\PasswordForm;
use App\Forms\EmailForm;

class UserController extends Controller
{
    protected $validateSettings = null;

    public function __construct ()
    {
        parent::__construct();

        $this->validateSettings = [
            'first' => 'required',
            'last' => 'required'
        ];
        $this->validatePassword = [
            'current_password' => 'required|password',
            'password' => 'required|confirmed'
        ];
        $this->validateEmail = [
            'confirm_password' => 'required|password',
            'email' => 'required|email'
        ];
    }

    public function settings (FormBuilder $fb)
    {
        $form = $fb->create(SettingsForm::class, [
            'method' => 'POST',
            'url' => url('settings'),
            'model' => $this->user
        ]);

        $passwordForm = $fb->create(PasswordForm::class, [
            'method' => 'POST',
            'url' => url('settings/password')
        ]);

        $emailForm = $fb->create(EmailForm::class, [
            'method' => 'POST',
            'url' => url('settings/email'),
            'model' => ['email' => $this->user->email]
        ]);

        return view('settings', compact('user', 'form', 'passwordForm', 'emailForm'));
    }

    public function updateSettings (Request $r)
    {
        $this->validate($r, $this->validateSettings);

        $this->user->first = $r->first;
        $this->user->last = $r->last;

        $this->user->save();

        return redirect('settings');
    }

    public function updatePassword (Request $r)
    {
        $this->validate($r, $this->validatePassword);

        $this->user->password = Hash::make($r->password);
        $this->user->save();

        return redirect('settings');
    }

    public function updateEmail (Request $r)
    {
        $this->validate($r, $this->validateEmail);
        $this->user->email = $r->email;
        $this->user->save();

        return redirect('settings');
    }

    public static function routes()
    {
        $controller = 'UserController@';
        Route::get('settings', $controller . 'settings');
        Route::post('settings', $controller . 'updateSettings');
        Route::post('settings/password', $controller . 'updatePassword');
        Route::post('settings/email', $controller . 'updateEmail');
    }
}
