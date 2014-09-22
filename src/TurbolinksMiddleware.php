<?php

/**
 * @file
 * Contains Drupal\turbolinks\TurbolinksMiddleware.
 */

namespace Drupal\turbolinks;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Helthe\Component\Turbolinks\Turbolinks;

class TurbolinksMiddleware implements HttpKernelInterface {

  /**
   * Stack\StackedHttpKernel definition.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  protected $app;

  public function __construct(HttpKernelInterface $app) {
    $this->app = $app;
  }

  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
    $response = $this->app->handle($request, $type, $catch);

    $turbolinks = new Turbolinks();
    return $turbolinks->decorateResponse($request, $response);
  }
}
