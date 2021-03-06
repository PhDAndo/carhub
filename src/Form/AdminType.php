<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fournisseur')
            ->add('titre')
            ->add('description')
            ->add('quantite_stock')
            ->add('marque')
            ->add('type')
            ->add('prix')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('sold', null, [
                'label' => 'Vendu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => produit::class
        ]);
    }
}
