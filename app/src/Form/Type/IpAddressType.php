<?php

namespace App\Form\Type;

use App\Form\DataTransformer\IpAddressTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class IpAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new IpAddressTransformer());
    }
    public function getParent(): string
    {
        return TextType::class;
    }
}
