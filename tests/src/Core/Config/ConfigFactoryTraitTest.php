<?php

namespace drunomics\ServiceUtils\Tests\Core\Config;

use drunomics\ServiceUtils\Core\Config\ConfigFactoryTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Config\ConfigFactoryTrait
 * @group ServiceUtils
 */
class ConfigFactoryTraitTest extends \PHPUnit_Framework_TestCase {

  use ConfigFactoryTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'config.factory';

  /**
   * @covers ::getConfigFactory
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getConfigFactory());
    // Multiple calls should fetch the service from the container only once.
    $this->getConfigFactory();
  }

  /**
   * @covers ::setConfigFactory
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(ConfigFactoryInterface::class)
      ->reveal();
    $this->setConfigFactory($service);
    $this->assertsame($service, $this->getConfigFactory());
  }

  /**
   * Helper to mock the container with a stub service.
   *
   * @param int[] $options
   *   An array with the following keys:
   *   - calls: The number of calls to get the service the mocked container
   *     expects.
   *
   * @return object
   *   The fake service returned by the container.
   */
  protected function mockContainerWithFakeService(array $options) {
    $service = new \Stdclass();
    $container = $this->prophesize(Container::class);
    $prophecy = $container->get($this->serviceId);
    /** @var \Prophecy\Prophecy\MethodProphecy $prophecy */
    $prophecy->shouldBeCalledTimes($options['calls']);
    $prophecy->willReturn($service);
    \Drupal::setContainer($container->reveal());
    return $service;
  }

}
