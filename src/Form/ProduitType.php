<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Libelle', TextType::class, [
                'label' => 'Libellé'
            ])
            ->add('Reference', TextType::class, [
                'label' => 'Référence'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'libelle',
                'label' => 'Catégorie',
                'attr' => array('style' => 'width: 130px')
            ])
            ->add('Prix', IntegerType::class, [
                'attr' => array('style' => 'width: 90px')
            ])
            ->add('Stock', IntegerType::class, [
                'attr' => array('style' => 'width: 60px')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
