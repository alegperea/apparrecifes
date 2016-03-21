<?php

namespace JGM\AgpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array(
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
                
            ))
            ->add('contacto' , 'text', array(
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
                
            ))
            ->add('direccion', 'text', array(
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
                
            )) 
            ->add('tipo', 'text', array(
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
                
            ))
            ->add('modalidadPago',  'text', array(
                
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
            ));

        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JGM\AgpBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jgm_agpbundle_cliente';
    }
}
