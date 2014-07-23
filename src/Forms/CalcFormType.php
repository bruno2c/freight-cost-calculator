<?php

namespace FreightCostCalculator\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CalcFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
        $builder->add('postcode', 'text');
        $builder->add('weight', 'text');
        $builder->add('volume', 'text');
        $builder->add('target_date', 'text');
	}

	public function getName()
	{
		return 'calc_form_type';
	}

}