<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notebook;
use App\Note;
use Route;
use Session;
use Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\NoteForm;

class NoteController extends Controller
{

    protected $validation = null;

    public function __construct ()
    {
        $this->validation = [
            'title' => 'required',
            'text' => 'required'
        ];
    }

    /* Index
     *
     * Returns the main view for Notes, which displays all of the user's notes
     * for a given notebook.
     *
     * @return view
     */
    public function index ($id)
    {
        $notebook = Notebook::findOrFail($id);

        $notes = $notebook->notes;
        return view('notes.index', compact('notes', 'notebook'));
    }

    /* Create note
     *
     * @return redirect
     */
    public function create (Request $r, $id)
    {
        // Make sure this is a valid notebook
        $notebook = Notebook::findOrFail($id);

        // Validate the request
        $this->validate($r, $this->validation);

        // Create the new Note
        $note = new Note;
        $note->title = $r->title;
        $note->text = $this->clean($r->text);
        $note->notebook_id = $id;
        $note->user_id = Auth::user()->id;
        $note->save();

        // Redirect to the newly created note
        return redirect('/notes/view/' . $note->id);
    }

    /* Create note form
     *
     * @return view
     */
    public function getCreateForm (FormBuilder $fb, $id)
    {
        // Make sure this is a valid notebook
        $notebook = Notebook::findOrFail($id);

        $form = $fb->create(NoteForm::class, [
            'method' => 'POST',
            'url' => url('/notes/create/' . $id)
        ]);

        return view('notes.form', compact('form', 'notebook'));
    }

    /* Edit note
     *
     * @return redirect
     */
    public function edit (Request $r, $id)
    {
        // Validate the request
        $this->validate($r, $this->validation);

        // Edit the Note
        $note = Note::withTrashed()->findOrFail($id);
        $note->title = $r->title;
        $note->text = $this->clean($r->text);
        $note->save();
        
        // Redirect back to the note
        return redirect('/notes/view/' . $note->id);
    }

    /* Edit note form
     *
     * @return view
     */
    public function getEditForm (FormBuilder $fb, $id)
    {
        // Set $edit to pass to the view, so that it toggles view/edit
        $edit = true;

        // Retrieve the Note record
        $note = Note::withTrashed()->findOrFail($id);
        $notebook = $note->notebook;

        $form = $fb->create(NoteForm::class, [
            'method' => 'POST',
            'url' => url('/notes/edit/' . $id),
            'model' => $note
        ]);


        return view('notes.form', compact('note', 'form', 'edit', 'notebook'));
    }

    /* View note
     *
     * @return view
     */
    public function view (FormBuilder $fb, $id)
    {
        // Retrieve the Note record
        $note = Note::withTrashed()->findOrFail($id);
        $notebook = $note->notebook;

        $form = $fb->create(NoteForm::class, [
            'method' => 'POST',
            'url' => url('notes/create'),
            'model' => $note,
            'class' => 'disabled'
        ]);

        return view('notes.form', compact('note', 'form', 'notebook'));
    }

    /* Delete note
     *
     * @return redirect
     */
    public function delete ($id)
    {
        $note = Note::withTrashed()->findOrFail($id);
        $note->delete();
        
        return redirect('/notes/view/' . $note->id);
    }

    /* Restore note
     *
     * @return redirect
     */
    public function restore ($id)
    {
        $note = Note::withTrashed()->findOrFail($id);
        $note->restore();

        return redirect('/notes/view/' . $note->id);
    }

    public static function routes ()
    {
        $controller = 'NoteController@';
        Route::get('notebooks/notes/{id}', $controller . 'index');
        Route::get('notes/create/{id}', $controller . 'getCreateForm');
        Route::post('notes/create/{id}', $controller . 'create');
        Route::get('notes/view/{id}', $controller . 'view');
        Route::get('notes/edit/{id}', $controller . 'getEditForm');
        Route::post('notes/edit/{id}', $controller . 'edit');
        Route::get('notes/delete/{id}', $controller . 'delete');
        Route::get('notes/restore/{id}', $controller . 'restore');
    }

}
