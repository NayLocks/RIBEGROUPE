<?php

namespace App\Form;

use App\Entity\Companies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => array(
                "class" => "form-control",
                "placeholder" => "HOLDING",

            )
        ])
        ->add('colorCode', ColorType::class, [
            'attr' => array(
                "class" => "form-control",
                "placeholder" => "#FFFFAA",
                
            )
        ])
        ->add('colorText', ColorType::class, [
            'attr' => array(
                "class" => "form-control",
                "placeholder" => "#FFFFAA",
                
            )
        ])
        ->add('databaseName', TextType::class, [
            'attr' => array(
                "class" => "form-control",
                "placeholder" => "TEST",
                
            )
        ])
        ->add('add', SubmitType::class, [
            'label' => "Ajouter la Société",
            'attr' => array(
                'class' => "btn btn-primary"
            )
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Companies::class,
        ]);
    }
}
