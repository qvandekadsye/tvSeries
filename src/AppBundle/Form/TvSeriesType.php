<?php
/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 21/01/17
 * Time: 13:41
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TvSeriesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('author', TextType::class)
            ->add('releaseDate',DateType::class)
            ->add('description',TextareaType::class)
            ->add('image',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TvSeries'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_tvSeries';
    }
}