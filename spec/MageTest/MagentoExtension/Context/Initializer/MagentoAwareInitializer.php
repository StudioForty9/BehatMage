<?php

namespace spec\MageTest\MagentoExtension\Context\Initializer;

use PHPSpec2\Specification;

class MagentoAwareInitializer implements Specification
{
    function described_with($bootstrap, $app, $config, $cache, $factory, $mink)
    {
        $bootstrap->isAMockOf('MageTest\MagentoExtension\Service\Bootstrap');
        $app->isAMockOf('Mage_Core_Model_App');
        $bootstrap->app()->willReturn($app);

        $cache->isAMockOf('MageTest\MagentoExtension\Service\CacheManager');
        $config->isAMockOf('MageTest\MagentoExtension\Service\ConfigManager');
        $factory->isAMockOf('MageTest\MagentoExtension\Fixture\FixtureFactory');
        $mink->isAMockOf('Behat\Mink\Mink');

        $this->magentoAwareInitializer->isAnInstanceOf(
            'MageTest\MagentoExtension\Context\Initializer\MagentoAwareInitializer',
            array($bootstrap, $cache, $config, $factory, $mink)
        );
    }

    /**
     * @param Prophet $context mock of MageTest\MagentoExtension\Context\MagentoContext
     */
    function it_initialises_the_context($context, $app, $config, $cache, $factory, $mink)
    {
        $context->setApp($app)->shouldBeCalled();
        $context->setConfigManager($config)->shouldBeCalled();
        $context->setCacheManager($cache)->shouldBeCalled();
        $context->setFixtureFactory($factory)->shouldBeCalled();
        $context->setMink($mink)->shouldBeCalled();
        $this->magentoAwareInitializer->initialize($context);
    }

}