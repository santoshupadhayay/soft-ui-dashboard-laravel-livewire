<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    protected $client;
    protected $driveService;

    public function __construct()
    {
        $this->client = new Google_Client();
        // $this->client->setClientId('577628334914-2tg8ut6qf957eldh3ih9eo2iikk6he3p.apps.googleusercontent.com');
        // $this->client->setClientSecret('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');
        // $this->client->setRedirectUri('http://localhost:8000');
        $this->client->setAuthConfig('C:\Users\1992a\Downloads\client_secret_577628334914-2tg8ut6qf957eldh3ih9eo2iikk6he3p.apps.googleusercontent.com.json');
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');
        $authUrl = $this->client->createAuthUrl();
        $this->client->setAccessToken('ya29.a0AfB_byCqLD4bx03DIvpZ0WwiXUWaCgNTYhGODi4O_MPI4KxCzaKMy1XL0vmANZiK2hte9DuYxPKWK-r4X7uBipzhPdz5JBoU4LJ-PFoV2IYyetebSplcz1pT9WFk2uME6XVNlVzZOku29C8V1zN6YJo4_b40-yJzKOsMaCgYKAewSARISFQGOcNnCcFTDJAXPcOpgU5858wID_A0171');
        $accessToken = $this->client->getAccessToken();
        // dd($accessToken);
        // dd($authUrl);
        $this->driveService = new \Google_Service_Drive($this->client);
    }

    public function authenticate(Request $request)
    {
        // Build the OAuth 2.0 URL for user authentication and consent
        $authUrl = $this->client->createAuthUrl();
        

        // Redirect the user to $authUrl to complete the authentication and consent process.
        return redirect($authUrl);
    }

    public function handleCallback(Request $request)
    {
        // After the user has authenticated and consented, you'll receive an access token
        $code = $request->input('code');
        $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);

        // Store the access token securely for future use (e.g., in a database).
        // You should also handle token refresh logic.

        // Use the access token to authenticate with Google Drive when making API requests.
    }


    public function uploadFile(Request $request)
    {
        // Handle file upload here and get the uploaded file object

        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $request->file('file')->getClientOriginalName()
        ]);

        $file = $this->driveService->files->create($fileMetadata, [
            'data' => file_get_contents($request->file('file')->getRealPath()),
            'mimeType' => $request->file('file')->getClientMimeType()
        ]);

        $fileId = $file->id;

        // Now you can generate a shareable link
        $fileLink = 'https://drive.google.com/file/d/' . $fileId . '/view';

        return $fileLink;
    }
}
