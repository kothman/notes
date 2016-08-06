<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NoteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text',
                  ['attr' => ['v-model' => 'title']])
            ->add('text', 'textarea')
            ->add('submit', 'submit',
                  ['label' => 'Save Note',
                  'attr' => ['class' => 'btn btn-primary']]);
    }
}
