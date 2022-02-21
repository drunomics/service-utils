<?php

namespace drunomics\ServiceUtils\Tests\Core\Language;

use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Language\LanguageManagerInterface;
use drunomics\ServiceUtils\Core\Language\LanguageMananagerTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Language\LanguageMananagerTrait
 * @group ServiceUtils
 */
class LanguageManagerTraitTest extends TestCase {

  use LanguageManagerTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'language_manager';

  /**
   * @covers ::getLanguageManager
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getLanguageManager());
    // Multiple calls should fetch the service from the container only once.
    $this->getLanguageManager();
  }

  /**
   * @covers ::setLanguageManager
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(LanguageManagerInterface::class)
      ->reveal();
    $this->setLanguageManager($service);
    $this->assertsame($service, $this->getLanguageManager());
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
