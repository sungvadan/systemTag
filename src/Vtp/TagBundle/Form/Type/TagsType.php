<?php
namespace Vtp\TagBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vtp\TagBundle\Form\DataTransformer\TagsTransformer;


class TagsType extends AbstractType{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {

        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CollectionToArrayTransformer(),true)
            ->addModelTransformer(new TagsTransformer($this->manager),true);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('required',false);
        $resolver->setDefault('attr',[
            'class' => 'tag-input'
        ]);
    }

    public function getParent()
    {
        return TextType::class;
    }

}
