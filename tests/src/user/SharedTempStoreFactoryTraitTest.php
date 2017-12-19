<?php

namespace drunomics\ServiceUtils\Tests\user;

use drunomics\ServiceUtils\user\SharedTempStoreFactoryTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\user\SharedTempStoreFactory;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\user\SharedTempStoreFactoryTrait
 * @group ServiceUtils
 */
class SharedTempStoreFactoryTraitTest extends \PHPUnit_Framework_TestCase {

  use SharedTempStoreFactoryTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'user.shared_tempstore';

  /**
   * @covers ::getSharedTempStoreFactory
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getSharedTempStoreFactory());
    // Multiple calls should fetch the service from the container only once.
    $this->getSharedTempStoreFactory();
  }

  /**
   * @covers ::setFileUsage
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willExtend(SharedTempStoreFactory::class)
      ->reveal();
    $this->setSharedTempStoreFactory($service);
    $this->assertsame($service, $this->getSharedTempStoreFactory());
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
