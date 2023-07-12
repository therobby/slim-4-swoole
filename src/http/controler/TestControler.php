<?php

declare(strict_types=1);

namespace App\http\controler;

use Psr\Http\Message\ResponseInterface;
use Imefisto\PsrSwoole\ServerRequest as Request;

class TestControler extends AbstractControler
{
    /**
     * Test http controler
     * 
     * @param Request           $request
     * @param ResponseInterface $response
     * @param array<string>     $args
     * 
     * @return ResponseInterface
     */
    public function __invoke(
        Request $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $body = '<!DOCTYPE html>
        <html lang="en">
            <head>
                <title>TEST</title>
            </head>
            <body>
                <h1>TEST</h1>
                <script>
                    const socket = new WebSocket("ws://localhost:9001");

                    // Connection opened
                    socket.addEventListener("open", (event) => {
                        socket.send("Hello Server!");
                    });
                    
                    // Listen for messages
                    socket.addEventListener("message", (event) => {
                        console.log("Message from server ", event.data);
                    });
                </script>
            </body>
        </html>';
        $response->getBody()->write($body);
        return $response;
    }
}
