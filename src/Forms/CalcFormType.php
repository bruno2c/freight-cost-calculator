<?php

namespace Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CalcFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{

	}

	public function getName()
	{
		return 'calc_form_type';
	}

}