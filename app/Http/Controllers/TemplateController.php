<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notebook;
use Route;

class NotebookController extends Controller
{

    protected $validation = null;

    public function __construct ()
    {
        $this->validation = [

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
        $notebooks = Notebooks::all();
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
        
        $notebook->save();

        // Redirect to the newly created notebook
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Create notebook form
     *
     * @return view
     */
    public function getCreateForm ()
    {
        return view('notebooks.create');
    }

    /* Edit notebook
     *
     * @return redirect
     */
    public function edit ($id)
    {
        // Validate the request
        $this->validate($r, $this->validation);

        // Edit the Notebook
        $notebook = Notebook::findOrFail($id);
        
        $notebook->save();
        
        // Redirect back to the notebook
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Edit notebook form
     *
     * @return view
     */
    public function getEditForm ($id)
    {
        // Retrieve the Notebook record
        $notebook = Notebook::findOrFail($id);

        return view('notebooks.edit', compact('notebook'));
    }

    /* View notebook
     *
     * @return view
     */
    public function view ($id)
    {
        // Retrieve the Notebook record
        $notebook = Notebook::findOrFail($id);

        return view('notebooks.view', compact('notebook'));
    }

    /* Delete notebook
     *
     * @return redirect
     */
    public function delete ($id)
    {
        $notebook = Notebook::findOrFail($id);
        $notebook->delete();
        
        return redirect('/notebooks/view/' . $notebook->id);
    }

    /* Restore notebook
     *
     * @return redirect
     */
    public function restore ($id)
    {
        $notebook = Notebook::findOrFail($id);
        $notebook->resore();

        return redirect('/notebooks/view/' . $notebook->id);
    }

    public static function routes ()
    {
        $controller = 'NotebookController@';
        Route::get('/notebooks', $controller . 'index');
        Route::get('/notebooks/create', $controller . 'getCreateView');
        Route::post('/notebooks/create', $controller . 'create');
        Route::get('/notebooks/view/{id}', $controller . 'view');
        Route::get('/notebooks/edit/{id}', $controller . 'getEditView');
        Route::post('/notebooks/edit/{id}', $controller . 'edit');
        Route::get('/notebooks/delete/{id}', $controller . 'delete');
        Route::get('/notebooks/restore/{id}', $controller . 'restore');
    }

}
