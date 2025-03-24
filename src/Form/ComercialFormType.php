<?php

namespace App\Form;

use App\Entity\Comercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComercialFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('fecha', null, [
                'widget' => 'single_text',
            ])
            ->add('fechaVenta', null, [
                'widget' => 'single_text',
            ])
            ->add('vendido')
            ->add('precioOferta')
            ->add('precioFinal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comercial::class,
        ]);
    }
}
