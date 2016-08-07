<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdminNoteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text',
                  ['attr' => ['v-model' => 'title']])
            ->add('notebook_id', 'text')
            ->add('text', 'textarea')
            ->add('submit', 'submit',
                  ['label' => 'Save Note',
                  'attr' => ['class' => 'btn btn-primary']]);
    }
}
