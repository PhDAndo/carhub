<?php

namespace App\Form;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fournisseur', $fournisseur)
            ->add('titre', $titre)
            ->add('description', $description)
            ->add('quantite_stock', $quantite_stock)
            ->add('marque', $marque)
            ->add('type', $type)
            ->add('prix', $prix)
            ->add('sold', $sold = false)
            ->add('created_at', $create_at)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
