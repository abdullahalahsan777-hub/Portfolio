<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand as BaseServeCommand;

class ServeCommand extends BaseServeCommand
{
    /**
     * Get the port for the command, prioritizing SERVER_PORT from .env.
     *
     * @return int
     */
    protected function port()
    {
        $port = $this->input->getOption('port');

        if (is_null($port)) {
            [, $port] = $this->getHostAndPort();
        }

        // If no explicit --port option was provided via CLI, retrieve from .env SERVER_PORT
        if (empty($port)) {
            $envPort = env('SERVER_PORT');
            if (!empty($envPort) && is_numeric($envPort)) {
                $port = (int) $envPort;
            } else {
                $port = (int) config('app.port', 8000);
            }
        }

        return (int) $port + $this->portOffset;
    }
}
