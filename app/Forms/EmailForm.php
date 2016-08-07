<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EmailForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('confirm_password', 'password',
                  ['label' => 'Confirm Password'])
            ->add('email', 'email',
                  ['label' => 'New Email',
                   'attr' => ['v-model' => 'email'],
                  ])
            ->add('button', 'submit',
                  ['label' => 'Update Email',
                   'attr' => [
                       'class' => 'btn btn-primary']]);
    }
}
