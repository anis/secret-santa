<?php
namespace Anis\SecretSanta\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttendeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array('label' => 'Adresse email :'));
        $builder->add('image', 'file', array('label' => 'Image :'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Anis\SecretSanta\Entity\Attendee',
            )
        );
    }

    public function getName()
    {
        return 'attendee';
    }
}
