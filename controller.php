<?php
$builder->add('mark', 'entity', array(
            'class' => 'XXXBundle:Mark',
            'property' => 'value',
            'attr' => array('class' => 'vh-mark'),
            'empty_value' => 'Marque',
            'mapped' => false
        ));
 
        $formEditModel = function (FormInterface $form, Mark $mark = null) {
            if (null === $mark) {
                $form->add('model', 'choice', array(
                    'disabled' => 'disabled'
                ));
            } else {
                $form->add('model', 'entity', array(
                    'class' => 'XXXBundle:Model',
                    'placeholder' => 'Modèle',
                    'property' => 'value',
                    'required' => true
                ));
            }
        };
 
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)
        use ($formEditModel) {
            $data = $event->getData();
 
            $formEditModel($event->getForm(), $data);
        });
 
        $builder->get('mark')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event)
        use ($formEditModel) {
            $mark = $event->getForm()->getData();
            $formEditModel($event->getForm()->getParent(), $mark);
        });
?>