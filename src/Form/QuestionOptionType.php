<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\QuestionOption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class QuestionOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::POST_SET_DATA, static function (FormEvent $event): void {
            /** @var QuestionOption $option */
            $option = $event->getData();

            $event->getForm()
                ->add('isChosen', null, [
                    'label' => $option->requireTitle(),
                ])
            ;
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionOption::class,
            'label' => false,
        ]);
    }
}
