<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_event')
            ->add('short_description_event')
            ->add('long_description_event')
            ->add('ref_provider_event')
            ->add('purchase_price_event')
            ->add('start_date_event')
            ->add('end_date_event')
            ->add('festival_place_event');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class
        ]);
    }
}
