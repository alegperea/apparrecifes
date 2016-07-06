<?php

namespace JGM\AgpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use JGM\AgpBundle\Entity\Cliente;

class EntregacontrolType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('descuentoEspecial', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('pagoRealizado', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('deuda', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('limpiezaRealizada', 'choice', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
		    'choices' => array(
			'Soft' => 'Soft',
			'Hard' => 'Hard'
		
		    ),
		    'expanded' => false,
                    'label' => 'Limpieza:',
		//    'empty_value' => 'Seleccione Nivel',
		    
		))
                ->add('co2Entregados', null, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('co2Retirados', null, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('co2Backup', null, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('co2Cambio', null, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('barrilesEntregados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('barrilesRetirados', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('barrilesCliente', 'integer', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))
                ->add('observacion', 'textarea', array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    ),
                ))

        ;
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
