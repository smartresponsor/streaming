<?php

declare(strict_types=1);

namespace App\Streaming;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/** Minimal standalone Symfony kernel used to verify Streaming package wiring independently of a host application. */
final class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
