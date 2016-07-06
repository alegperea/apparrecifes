<?php

namespace JGM\AgpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use JGM\AgpBundle\Entity\Cliente;

class ControlType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('barrilesEntregados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('barrilesRetirados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('barrilesCliente', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('co2Entregados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('co2Retirados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('co2Backup', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('descuentoEspecial', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                    'required' => false
                ))
                ->add('pagoRealizado', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('deuda', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                
                ->add('limpiezaRealizada', 'choice', array(
		    'choices' => array(
			'1' => 'Soft',
			'2' => 'Hard',	
		    ),
                    'attr' => array(
                        'class' => 'col-md-7 col-xs-12 select2_single form-control',        
                    ),
		    'expanded' => false,
		    'label' => 'Seleccione limpiaza',
		//    'empty_value' => 'Seleccione Nivel',
		     'required' => true
		))
                
                ->add('observacion', 'textarea', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
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
