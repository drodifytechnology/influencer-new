<?php

namespace Laravel\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Laravel\LaravelInstaller\Events\LaravelInstallerFinished;
use Laravel\LaravelInstaller\Helpers\EnvironmentManager;
use Laravel\LaravelInstaller\Helpers\FinalInstallManager;
use Laravel\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    function __construct()
    {
        set_time_limit(300);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param \Laravel\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \Laravel\LaravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \Laravel\LaravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
