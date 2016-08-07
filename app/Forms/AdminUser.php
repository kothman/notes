<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AdminUser extends Form
{
    public function buildForm()
    {
        $this
            ->add('first', 'text',
                   ['label' => 'First Name'])
            ->add('last', 'text',
                  ['label' => 'Last Name'])
            ->add('email', 'email')
            ->add('admin', 'checkbox')
            ->add('button', 'submit',
                  ['label' => 'Update User',
                   'attr' => ['class' => 'btn btn-primary']]);
    }
}
