<?php

namespace App\Form;

use DateTime;
use App\Entity\Playlist;
use App\Entity\Categorie;
use App\Entity\Formation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('publishedAt', DateType::class,[
            'widget' => 'single_text',
            'data' => isset($options['data']) &&
                $options['data']->getPublishedAt() != null ? $options['data']->getPublishedAt() : new DateTime('now'),
            'label' => 'Date',
            'required' => true
        ])
        ->add('title', null, [
            'label' => 'Titre',
            'required' => true
        ])
        ->add('description', null, [
            'label' => 'Description',
            'required' => false
        ])
        
        ->add('playlist', EntityType::class, [
              'class' => Playlist::class,
              'choice_label' => 'name',
              'label' => 'Playlist',
              'required' => true
        ])
        ->add('categories', EntityType::class, [
              'class' => Categorie::class,
              'choice_label' => 'name',
              'multiple' => true,
              'label' => 'Catégorie',
              'required' => true
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
            
        ]);
    }
}
