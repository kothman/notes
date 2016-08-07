<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdminNotebookForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('user_id', 'text')
            ->add('description', 'textarea')
            ->add('submit', 'submit',
                  ['label' => 'Save Notebook',
                  'attr' => ['class' => 'btn btn-primary']]);
    }
}
