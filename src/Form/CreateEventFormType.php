<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Adress;
use App\Entity\Campus;
use App\Entity\Event;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', null, [
                "label" => "Nom de l'événement : "
            ])
            ->add('campus', EntityType::class, [
                "class" => Campus::class,
                "choice_label" => "name",
                "label" => "Quelle ville de Campus ? : ",
            ])
            ->add('dateD', null, [
                "label" => "Quand est-ce que ça va commencer ? : ",
                'widget' => 'single_text',

            ])
            ->add('time', null, [
                "label" => "Combien de temps ça va durer ? : ",

            ])
            ->add('limiteDate', null, [
                "label" => "Date limite d'inscription : ",
                'widget' => 'single_text',

            ])
            ->add('nbMaxInsc', null, [
                "label" => " Personnes limitées à : ",

            ])
            ->add('infosEvent', null, [
                "label" => " Informations : ",

            ])
            ->add('address', TextType::class, [
                "label" => "Adresse : "
            ])
            ->add('status', EntityType::class, [
                "class" => Status::class,
//                C'est ce qui va se mettre dans ton <select><option>
                "choice_label" => 'name',
                "label" => " Status : ",
            ])
            ->add('create', SubmitType::class, [
                "label" => "Création",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
