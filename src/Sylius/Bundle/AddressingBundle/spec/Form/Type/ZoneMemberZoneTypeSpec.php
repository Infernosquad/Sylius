<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AddressingBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class ZoneMemberZoneTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('ZoneMember', array('sylius'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AddressingBundle\Form\Type\ZoneMemberZoneType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function it_is_a_Sylius_zone_member_type()
    {
        $this->shouldHaveType('Sylius\Bundle\AddressingBundle\Form\Type\ZoneMemberType');
    }

    function it_has_a_valid_name()
    {
        $this->getName()->shouldReturn('sylius_zone_member_zone');
    }

    function it_builds_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('zone', 'sylius_zone_choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $builder
            ->add('_type', 'hidden', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array());
    }

    function it_defines_assigned_data_class(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'data_class'        => 'ZoneMember',
                    'validation_groups' => array('sylius')
                )
            )
            ->shouldBeCalled();

        $this->configureOptions($resolver);
    }
}
