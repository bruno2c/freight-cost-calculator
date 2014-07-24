<?php

namespace FreightCostCalculator\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CalcFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
        $builder->add('postcode', 'text', array('attr' => array('class' => 'postcode')));
        $builder->add('weight', 'text', array('attr' => array('class' => 'weight')));
        $builder->add('volume', 'text', array('attr' => array('class' => 'volume')));
        $builder->add('target_date', 'text', array('attr' => array('class' => 'date')));
	}

	public function getName()
	{
		return 'calc_form_type';
	}

}