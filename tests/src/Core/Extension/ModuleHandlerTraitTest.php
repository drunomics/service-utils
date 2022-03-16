<?php

namespace drunomics\ServiceUtils\Tests\Core\Extension;

use PHPUnit\Framework\TestCase;
use drunomics\ServiceUtils\Core\Extension\ModuleHandlerTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Extension\ModuleHandlerTrait
 * @group ServiceUtils
 */
class ModuleHandlerTraitTest extends TestCase {

  use ModuleHandlerTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'module_handler';

  /**
   * @covers ::getModuleHandler
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getModuleHandler());
    // Multiple calls should fetch the service from the container only once.
    $this->getModuleHandler();
  }

  /**
   * @covers ::setModuleHandler
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(ModuleHandlerInterface::class)
      ->reveal();
    /** @var \Drupal\Core\Extension\ModuleHandlerInterface $service */
    $this->setModuleHandler($service);
    $this->assertsame($service, $this->getModuleHandler());
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
