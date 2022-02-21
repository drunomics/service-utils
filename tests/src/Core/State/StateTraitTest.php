<?php

namespace drunomics\ServiceUtils\Tests\Core\State;

use drunomics\ServiceUtils\Core\State\StateTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\State\StateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\State\StateTrait
 * @group ServiceUtils
 */
class StateTraitTest extends TestCase {

  use StateTrait;
  use ProphecyTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'state';

  /**
   * @covers ::getState
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getState());
    // Multiple calls should fetch the service from the container only once.
    $this->getState();
  }

  /**
   * @covers ::setState
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(StateInterface::class)
      ->reveal();
    $this->setState($service);
    $this->assertsame($service, $this->getState());
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
