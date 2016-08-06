<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NotebookForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('submit', 'submit',
                  ['label' => 'Save Notebook',
                  'attr' => ['class' => 'btn btn-primary']]);
    }
}
