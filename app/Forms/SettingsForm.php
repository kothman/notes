<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first', 'text',
                  ['label' => 'First Name',
                   'attr' => [
                       'v-model' => 'first'
                   ]])
            ->add('last', 'text',
                  ['label' => 'Last Name',
                   'attr' => [
                       'v-model' => 'last'
                   ]])
            ->add('submit', 'submit',
                  ['label' => 'Update Information',
                   'attr' => ['class' => 'btn btn-primary']]);
    }
}
