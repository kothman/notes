<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Requests;
use App\User;
use App\Notebook;
use App\Note;
use Route;

class AdminController extends Controller
{

    protected $validateUser = null;
    protected $validateNote = null;
    protected $validateNotebook = null;

    public function __construct()
    {
        $this->validateUser = [
            'first' => 'required',
            'last' => 'required',
            'email' => 'required',
        ];

        $this->validateNote = [
            'title' => 'required',
            'text' => 'required',
            'notebook_id' => 'required|exists:notebooks,id'
        ];

        $this->validateNotebook = [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function users()
    {
        $users = User::withTrashed()->get();

        return view('admin.users', compact('users'));
    }

    public function viewUser(FormBuilder $fb, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $form = $fb->create(\App\Forms\AdminUser::class, [
            'method' => 'POST',
            'url' => url('admin/users/edit/' . $id),
            'model' => [
                'first' => $user->first,
                'last' => $user->last,
                'email' => $user->email,
                'admin' => $user->admin
            ]
        ]);

        return view('admin.form', compact('user', 'form'));
    }

    public function updateUser(Request $r, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $this->validate($r, $this->validateUser);

        $user->first = $r->first;
        $user->last = $r->last;
        $user->email = $r->email;
        $user->admin = $r->admin;
        $user->save();
        
        return redirect()->action('AdminController@viewUser', [$user->id]);
    }

    public function notebooks()
    {
        $notebooks = Notebook::withTrashed()->get();

        return view('admin.notebooks', compact('notebooks'));
    }

    public function viewNotebook(FormBuilder $fb, $id)
    {
        $notebook = Notebook::withTrashed()->findOrFail($id);

        $form = $fb->create(\App\Forms\AdminNotebookForm::class, [
            'method' => 'POST',
            'url' => url('admin/notebooks/edit/' . $id),
            'model' => $notebook
        ]);

        return view('admin.form', compact('notebook', 'form'));
    }

    public function updateNotebook(Request $r, $id)
    {
        $notebook = Notebook::withTrashed()->findOrFail($id);

        $this->validate($r, $this->validateNotebook);

        $notebook->title = $r->title;
        $notebook->user_id = $r->user_id;
        $notebook->description = $r->description;
        $notebook->save();

        return redirect()->action('AdminController@viewNotebook', [$notebook->id]);
    }

    public function notes()
    {
        $notes = Note::withTrashed()->get();

        return view('admin.notes', compact('notes'));
    }

    public function viewNote(FormBuilder $fb, $id)
    {
        $note = Note::withTrashed()->findOrFail($id);

        $form = $fb->create(\App\Forms\AdminNoteForm::class, [
            'method' => 'POST',
            'url' => url('admin/notes/edit/' . $id),
            'model' => $note
        ]);

        return view('admin.form', compact('note', 'form'));
    }

    public function updateNote(Request $r, $id)
    {
        $note = Note::withTrashed()->findOrFail($id);

        return redirect()->action('AdminController@viewNote', [$note->id]);
    }

    public static function routes()
    {
        Route::get('admin/users', 'AdminController@users');
        Route::get('admin/users/view/{id}', 'AdminController@viewUser');
        Route::post('admin/users/edit/{id}', 'AdminController@updateUser');
        Route::get('admin/notes', 'AdminController@notes');
        Route::get('admin/notes/view/{id}', 'AdminController@viewNote');
        Route::post('admin/notes/edit/{id}', 'AdminController@updateNote');
        Route::get('admin/notebooks', 'AdminController@notebooks');
        Route::get('admin/notebooks/view/{id}', 'AdminController@viewNotebook');
        Route::post('admin/notebooks/edit/{id}', 'AdminController@updateNotebook');

    }
}
