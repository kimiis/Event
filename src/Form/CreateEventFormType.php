<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Adress;
use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\Status;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityRepository;
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
                "label" => "Name of the event : "
            ])
            ->add('campus', EntityType::class, [
                "class" => Campus::class,
                "choice_label" => "name",
                "label" => "Which campus ? : ",
            ])
            ->add('dateD', null, [
                "label" => "When will it begin? : ",
                'widget' => 'single_text',

            ])
            ->add('time', null, [
                "label" => "How long will it last ? : ",

            ])
            ->add('limiteDate', null, [
                'widget' => 'single_text',

            ])
            ->add('nbMaxInsc', null, [
                "label" => " Limite for entries: ",

            ])
            ->add('infosEvent', null, [
                "label" => " Infomations: ",

            ])
            ->add('Place', EntityType::class, [
                "class" => Place::class,
                "label" => "Place Address",
                "query_builder" => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('p')
//                        ->orderBy('p.city', 'ASC');
                        ->orderBy('p.name', 'ASC');
                }
            ])
            ->add('status', EntityType::class, [
                "class" => Status::class,
//                C'est ce qui va se mettre dans ton <select><option>
                "choice_label" => 'name',
                "label" => " Status: ",
            ])
            ->add('create', SubmitType::class, [
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
