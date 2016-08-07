<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PasswordForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('current_password', 'password',
                  ['label' => 'Current Password'])
            ->add('password', 'password',
                  ['label' => 'New Password',
                   'attr' => ['v-model' => 'password']])
            ->add('password_confirmation', 'password',
                  ['label' => 'Confirm Password',
                   'attr' => ['v-model' => 'password_confirmation']])
            ->add('submit', 'submit',
                  ['label' => 'Update Password',
                   'attr' => ['class' => 'btn btn-primary']]);
    }
}
