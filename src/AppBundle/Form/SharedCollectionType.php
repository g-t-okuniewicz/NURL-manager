<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SharedCollectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('collection')->add('shared_by')->add('shared_with');
        $builder->add('collection', EntityType::class, [
            'class' => 'AppBundle:Collection',
            'choice_label' => 'id'
        ]);
        $builder->add('shared_by', EntityType::class, [
            'class' => 'AppBundle:User',
            'choice_label' => 'username'
        ]);
        $builder->add('shared_with', EntityType::class, [
            'class' => 'AppBundle:User',
            'choice_label' => 'username'
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SharedCollection'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sharedcollection';
    }


}
