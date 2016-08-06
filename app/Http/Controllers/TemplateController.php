<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notebook;
use Route;
use Session;
use Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\NotebookForm;

class NotebookController extends Controller
{

    protected $validation = null;

    public function __construct ()
    {
        $this->validation = [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    /* Index
     *
     * Returns the main view for Notebooks, which displays all of the user's notebooks.
     *
     * @return view
     */
    public function index ()
    {
        $notebooks = Notebook::all();
        return view('notebooks.index', compact('notebooks'));
    }

    /* Create notebook
     *
     * @return redirect
     */
    public function create (Request $r)
    {
        // Validate the request
        $this->validate($r, $this->validation);

        // Create the new Notebook
        $notebook = new Notebook;
        $notebook->title = $r->title;
        $notebook->description = $r->description;
        $notebook->user_id = Auth::user()->id;
        $notebook->save();

        // Redirect to the newly created notebook
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Create notebook form
     *
     * @return view
     */
    public function getCreateForm (FormBuilder $fb)
    {
        $form = $fb->create(NotebookForm::class, [
            'method' => 'POST',
            'url' => url('notebooks/create')
        ]);

        return view('notebooks.form', compact('form'));
    }

    /* Edit notebook
     *
     * @return redirect
     */
    public function edit (Request $r, $id)
    {
        // Validate the request
        $this->validate($r, $this->validation);

        // Edit the Notebook
        $notebook = Notebook::withTrashed()->findOrFail($id);
        $notebook->title = $r->title;
        $notebook->description = $r->description;        
        $notebook->save();
        
        // Redirect back to the notebook
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Edit notebook form
     *
     * @return view
     */
    public function getEditForm (FormBuilder $fb, $id)
    {
        // Set $edit to pass to the view, so that it toggles view/edit
        $edit = true;

        // Retrieve the Notebook record
        $notebook = Notebook::withTrashed()->findOrFail($id);

        $form = $fb->create(NotebookForm::class, [
            'method' => 'POST',
            'url' => url('notebooks/edit/' . $id),
            'model' => $notebook
        ]);


        return view('notebooks.form', compact('notebook', 'form', 'edit'));
    }

    /* View notebook
     *
     * @return view
     */
    public function view (FormBuilder $fb, $id)
    {
        // Retrieve the Notebook record
        $notebook = Notebook::withTrashed()->findOrFail($id);

        $form = $fb->create(NotebookForm::class, [
            'method' => 'POST',
            'url' => url('notebooks/create'),
            'model' => $notebook,
            'class' => 'disabled'
        ]);

        return view('notebooks.form', compact('notebook', 'form'));
    }

    /* Delete notebook
     *
     * @return redirect
     */
    public function delete ($id)
    {
        $notebook = Notebook::withTrashed()->findOrFail($id);
        $notebook->delete();
        
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Restore notebook
     *
     * @return redirect
     */
    public function restore ($id)
    {
        $notebook = Notebook::withTrashed()->findOrFail($id);
        $notebook->restore();

        return redirect('/notebooks/view/' . $notebook->id);
    }

    public static function routes ()
    {
        $controller = 'NotebookController@';
        Route::get('/notebooks', $controller . 'index');
        Route::get('/notebooks/create', $controller . 'getCreateForm');
        Route::post('/notebooks/create', $controller . 'create');
        Route::get('/notebooks/view/{id}', $controller . 'view');
        Route::get('/notebooks/edit/{id}', $controller . 'getEditForm');
        Route::post('/notebooks/edit/{id}', $controller . 'edit');
        Route::get('/notebooks/delete/{id}', $controller . 'delete');
        Route::get('/notebooks/restore/{id}', $controller . 'restore');
    }

}
