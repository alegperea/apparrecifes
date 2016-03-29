<?php

namespace JGM\AgpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProductoType extends AbstractType
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
        
            ->add('precio', 'text', array(
                'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',        
                    ),
                
            )) 
   
            ->add('categoria', 'choice', array(
		    'choices' => array(
			'Cream Ale' => 'Cream Ale',
			'Scottish Ale' => 'Scottish Ale',
			'Honey Ale' => 'Honey Ale',
                        'Belgian Witbier' => 'Belgian Witbier',
		    ),
                    'attr' => array(
                        'class' => 'col-md-7 col-xs-12 select2_single form-control',        
                    ),
		    'expanded' => false,
		    'label' => 'Seleccione categoría',
		//    'empty_value' => 'Seleccione Nivel',
		     'required' => true
		));

        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JGM\AgpBundle\Entity\Producto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jgm_agpbundle_producto';
    }
}
