<?php

namespace drunomics\ServiceUtils\Tests\Core\Path;

use drunomics\ServiceUtils\Core\Path\PathautoGeneratorTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\pathauto\PathautoGeneratorInterface;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Path\PathautoGeneratorTrait
 * @group ServiceUtils
 */
class PathautoGeneratorTraitTest extends \PHPUnit_Framework_TestCase {

  use PathautoGeneratorTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'pathauto.generator';

  /**
   * @covers ::getPathautoGenerator
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getPathautoGenerator());
    // Multiple calls should fetch the service from the container only once.
    $this->getPathautoGenerator();
  }

  /**
   * @covers ::setPathautoGenerator
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(PathautoGeneratorInterface::class)
      ->reveal();
    $this->setPathautoGenerator($service);
    $this->assertsame($service, $this->getPathautoGenerator());
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
