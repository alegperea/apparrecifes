<?php

namespace JGM\AgpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use JGM\AgpBundle\Entity\Cliente;

class EntregaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fecha', 'date', array(
                    'format' => 'dd/MM/yyyy',
                    'widget' => 'single_text',
                    'label' => "Fecha de entrega (ej: 12/12/2016)",
                    'attr' => array(
                        'class' => 'form-control has-feedback-left col-md-12 col-xs-12',
                        'id' => '#single_cal2'
                    ),
                ))
                ->add('cliente', 'entity', array(
                    'class' => 'AgpBundle:Cliente',
                    'property' => 'nombre',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                ->orderBy('c.nombre', 'ASC');
                    },
                    'label' => 'Cliente',
                    'attr' => array(
                        'class' => 'col-md-12 col-xs-12 select2_single form-control'
                    )
                ));
      
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JGM\AgpBundle\Entity\Entrega'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'jgm_agpbundle_entrega';
    }

}
