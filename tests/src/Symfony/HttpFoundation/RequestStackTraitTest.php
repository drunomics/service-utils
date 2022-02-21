<?php

namespace drunomics\ServiceUtils\Tests\Symfony\HttpFoundation;

use drunomics\ServiceUtils\Symfony\HttpFoundation\RequestStackTrait;
use Drupal\Core\DependencyInjection\Container;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Symfony\HttpFoundation\RequestStackTrait
 * @group ServiceUtils
 */
class RequestStackTraitTest extends TestCase {

  use RequestStackTrait;
  use ProphecyTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'request_stack';

  /**
   * @covers ::getRequestStack
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getRequestStack());
    // Multiple calls should fetch the service from the container only once.
    $this->getRequestStack();
  }

  /**
   * @covers ::setRequestStack
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willExtend(RequestStack::class)
      ->reveal();
    $this->setRequestStack($service);
    $this->assertsame($service, $this->getRequestStack());
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
